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
use common\widgets\owlCarousel\entities\OwlCarousel;

class OwlCarouselWidget extends Widget
{
    public $widgetId;

    public $entity;

    public $clientOptions = [];

    public $clientEvents = [];
    
    public function init()
    {
        parent::init();
        
        if ($this->entity === null) {
            throw new InvalidConfigException('The "entity" property must be set.');
        }

        if (!$this->entity instanceof OwlCarousel) {
            throw new InvalidConfigException('The "entity" must instance of ' . OwlCarousel::class);
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

        return $this->render('index', ['entity' => $this->entity]);
    }

    
    /**
     * Register assets.
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        // OwlCarouselAsset::register($view);

    }

}