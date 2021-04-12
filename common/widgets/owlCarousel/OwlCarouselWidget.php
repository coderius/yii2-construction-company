<?php
namespace common\widgets\owlCarousel;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use Closure;

class OwlCarouselWidget extends Widget
{
    public $widgetId;

    public $header;

    public $clientOptions = [];

    public $clientEvents = [];
    
    public function init()
    {
        parent::init();
        
        if ($this->header === null) {
            throw new InvalidConfigException('The "header" property must be set.');
        }

        if (!($this->widgetId)) {
            $this->widgetId = $this->getId();
        }
        
    }

    public function run()
    {
        $this->registerAssets();
        
        // $row =  Html::tag('div', $content, ["class" => "row linkbox", "id" => $this->widgetId]);
        // echo Html::tag('div', $row, ["class" => "container-fluid"]);

        return $this->render('index');
    }

    
    /**
     * Register assets.
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        OwlCarouselAsset::register($view);

    }

}