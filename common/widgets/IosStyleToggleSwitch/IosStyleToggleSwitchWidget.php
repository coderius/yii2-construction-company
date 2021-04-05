<?php
namespace common\widgets\IosStyleToggleSwitch;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\InvalidArgumentException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\InputWidget;

/**
 * Виджет 
 */

class IosStyleToggleSwitchWidget extends InputWidget
{
    const CHECKBOX = "checkbox";
//    const RADIO = "radio";
    
    public $type;
    
    public $class = 'm_switch_check';

    public $turnOnValue = 1;

    public $turnOffValue = 0;
    
    public $typesList = [
        self::CHECKBOX, 
//        self::RADIO
            ];
    
    public function init()
    {
        parent::init();

        if ($this->type == null) {
//            throw new InvalidConfigException('In :'.__CLASS__.' Not set or not array: $list' );
            $this->type = self::CHECKBOX;
            
        }
        
        if (empty($this->type) || !in_array($this->type, $this->typesList)) {
//            var_dump(in_array($this->type, $this->typesList)); die;
            throw new InvalidConfigException("Type not set. Type must be either checkbox or radio.");
        }
        
        
        
    }
//?netbeanse-xdebug
    public function run()
    {
        parent::run();
        
        if($this->type === self::CHECKBOX){
            $input = $this->getInput($this->type);
//            $error = $this->field->error();
        }
       
//        var_dump($error);
//        if($this->type === self::RADIO){
//            $input = $this->getInput($this->type);
//        }
        
        $this->registerAssets();
//        $output =  $input;
//        $output .=  Html::tag('div', $content = '', $options = ['class' => 'help-block']);
        
        echo $input;
    }

    protected function getInput($type)
    {
        if (empty($this->options['label'])) {
                $this->options['label'] = null;
        }
        
        $options = \yii\helpers\ArrayHelper::merge(
                $this->options, ['class' => $this->class]
        );
        
//        var_dump($this->value);
        
        if ($this->hasModel()) {
            $input = 'active' . ucfirst($type);
//            $options['uncheck'] = false;//убираем hiddeninput
//            $options['for']
            //"help-block"
            
            return Html::$input($this->model, $this->attribute, $options);
        } else {
            if ($type == self::CHECKBOX) {
                $input = $type;
                $checked = false;
                return Html::$input($this->name, $checked, $options);
            }else{
                throw new InvalidArgumentException("Field type not supported");
            }
            
        }
    }
    
    /**
     * Register assets.
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        IosStyleToggleSwitchAsset::register($view);
        
        $js = <<<JS
        
        $(".{$this->class}").mSwitch({
            onRendered: function(){},
            onRender: function(elem){},
            onTurnOn: function(elem){
//              console.log(elem);
                elem.val({$this->turnOnValue});
            },
            onTurnOff: function(elem){
                elem.val({$this->turnOffValue});
            }
        });

        
JS;

        $view->registerJs($js, \yii\web\View::POS_READY);
        
    }




}