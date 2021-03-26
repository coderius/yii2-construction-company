<?php
namespace common\widgets\materialList;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use Closure;

/**
 * Виджет 
 */

class MaterialListWidget extends Widget
{
    public $widgetId;
    
    /**
     * @var \yii\data\DataProviderInterface the data provider for the view. This property is required.
     */
    public $query;
    
    public $emptyText;
    
    public $emptyTextOptions = ['class' => 'empty'];
    
    public $layout = "{header}\n{items}";//{header}\n{items}\n{pager}
    
    public $itemView = "_item";
    
    public $itemOptionsDefault = ['class' => 'col-md-4 col-sm-6 linkbox-wrap'];
    
    public $itemOptions = [];
    
    public $itemViewParams = ['image', 'category', 'title', 'date', 'link'];
    
    public $headerText;
    
    public $headerView = "_header";
    
    const EVENT_BEFORE_RENDER_ITEM = 'beforeRenderItem';
    
    const EVENT_AFTER_RENDER_ITEM = 'afterRenderItem';
    
    /*
     * Additional parameters to be passed to $itemView when it is being rendered.
     */
//    public $viewParams;
    
    /**
     * @var string the HTML code to be displayed between any two consecutive items.
     */
    public $separator = "\n";
    
    public function init()
    {
        parent::init();
        
        if ($this->query === null) {
            throw new InvalidConfigException('The "query" property must be set.');
        }
        if ($this->emptyText === null) {
            $this->emptyText = Yii::t('yii', 'No results found.');
        }
        if (!($this->widgetId)) {
            $this->widgetId = $this->getId();
        }
        
    }

    public function run()
    {
        $this->registerAssets();
        
        if ($this->query->count() > 0) {
            $content = preg_replace_callback('/{\\w+}/', function ($matches) {
                $content = $this->renderSection($matches[0]);

                return $content === false ? $matches[0] : $content;
            }, $this->layout);
        } else {
            $content = $this->renderEmpty();
        }
//var_dump($content); die;
        
        $row =  Html::tag('div', $content, ["class" => "row linkbox", "id" => $this->widgetId]);
        echo Html::tag('div', $row, ["class" => "container-fluid"]);

    }

    
    public function renderSection($name)
    {
        switch ($name) {
            case '{header}':
                return $this->renderHeader();
            case '{items}':
                return $this->renderItems();
            
            default:
                return false;
        }
    }
    
    public function renderHeader()
    {        
        if(!$this->headerText){
            $content = '';
            
        }elseif (is_string($this->headerText)){
            $content =  $this->render($this->headerView, ['headerText' => $this->headerText]);
        }else {
            $content = call_user_func($this->headerText, $this->query);
        }
        
        return $content;
    }
    
    /**
     * Renders all data models.
     * @return string the rendering result
     */
    public function renderItems()
    {
        $models = $this->query->all();
        $rows = [];
        $index = 0;
        foreach ($models as $model) {
            
            if (!$this->beforeRenderItem($model, $index)) {
                continue;
            }
            
            $item =  $this->renderItem($model, $index);
            $rows[] = $item;
            
            if (($after = $this->afterRenderItem($model, $index)) !== null) {
                $rows[] = $after;
            }
            
            
            
            $index += 1;
        }

        return implode($this->separator, $rows);
    }
    
    public function renderItem($model, $index)
    {
        $params = [];
        foreach($this->itemViewParams as $param => $value){
            if($value instanceof Closure){
                $params[$param] = call_user_func($value, $model);
//                var_dump($this->itemViewParams);die;
            }else if(is_string($value)){
                $params[$param] = $value;
            }
        }
        
        if ($this->itemOptions instanceof Closure) {
            $options = call_user_func($this->itemOptions, $model, $index);
        } else {
            $options = $this->itemOptions;
        }
        
        $options = ArrayHelper::merge($this->itemOptionsDefault, $options);
        

        $tag = ArrayHelper::remove($options, 'tag', 'div');
        $content = $this->render($this->itemView, $params);
        
        return Html::tag($tag, $content, $options);
    }
    
    
    
    public function beforeRenderItem($model, $index)
    {
        $event = new WidgetEvent();
        $event->model = $model;
        $event->indexElement = $index;
        $this->trigger(self::EVENT_BEFORE_RENDER_ITEM, $event);
        return $event->isValid;
    }
    
    public function afterRenderItem($model, $index)
    {
        
        $event = new WidgetEvent();
        $event->result = null;
        $event->model = $model;
        $event->indexElement = $index;
        $this->trigger(self::EVENT_AFTER_RENDER_ITEM, $event);
        return $event->result;
    }
    
    public function renderEmpty()
    {
        if ($this->emptyText === false) {
            return '';
        }
        $options = $this->emptyTextOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        return Html::tag($tag, $this->emptyText, $options);
    }
    
    /**
     * Register assets.
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        MaterialListAsset::register($view);
        
    }

}