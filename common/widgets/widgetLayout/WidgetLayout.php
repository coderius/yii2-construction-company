<?php
namespace common\widgets\widgetLayout;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use frontend\models\Widgets;

class WidgetLayout extends Widget
{
    /**
     * @var array the parameters (name => value) to be extracted and made available in the decorative view.
     */
    public $params = [];
    /**
     * Content name in template
     *
     * @var string
     */
    public $contentMark = 'content';

    /**
     * Widget types from DB and equal class
     *
     * @var array
     */
    public $typesWidget = [
        'widget_carousel' => \common\widgets\carousel\CarouselWidget::class,
    ];

    public $typesModel = [
        'widget_carousel' => \frontend\models\WidgetCarousel::class,
    ];

    /**
     * Starts recording a clip.
     */
    public function init()
    {
        parent::init();

        // if ($this->viewFile === null) {
        //     throw new InvalidConfigException('ContentDecorator::viewFile must be set.');
        // }

        if(!isset($this->params['template'])){
            $this->params['template'] = $this->getView()->params['WidgetLayout'];
        }

        if(!in_array($this->contentMark, $this->params['template'])){
            throw new InvalidConfigException("{$this->contentMark} must be set.");
        }
        
        ob_start();
        ob_implicit_flush(false);
    }

    /**
     * Ends recording a clip.
     * This method stops output buffering and saves the rendering result as a named clip in the controller.
     */
    public function run()
    {
        $view = $this->getView();
        $content = ob_get_clean();
        // $params = $this->params;
        $page = $this->buildContent($content, $this->params['template']);
        
        // var_dump($this->params);
        return $page;
    }
/**
 * Template array example:
 * [
 * 0 => 1
 * 1 => 'content'
 * 2 => 3
 * ]
 * Values equals to widget id in `widgets` table
 * From `widgets` table we get type. For example type 'widget_carousel' equals to model \frontend\models\WidgetCarousel::class
 * That's how we take all data from WidgetCarousel::class by id from template and past them to widget (like this $widgetClass::widget(['model' => $model]))
 * @return void
 */
    public function buildContent($content, $template)
    {
        // var_dump($template);
        $result = [];
        foreach($template as $item){
            if($item === $this->contentMark){
                $result[] = $content;
            }else{
                $id = $item;
                $w = Widgets::findOne(['id' => $id]);
                $type = $w->type;
                $widgetClass = $this->typesWidget[$type];
                $modelClass = $this->typesModel[$type];
                $model = $modelClass::find()->where(['widgetId' => $id])->all();
                $widget = $widgetClass::widget(['model' => $model]);

                $result[] = $widget;
            }
        }

        return implode('', $result);
    }

    


}
