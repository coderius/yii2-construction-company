<?php
namespace common\widgets\fact;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use Closure;

/**
 * Widget
 */

class FactWidget extends Widget
{
    public $widgetId;
    public $model;
    
    public function init()
    {
        parent::init();
        
        if ($this->model === null) {
            throw new InvalidConfigException('The "model" property must be set.');
        }
        // if ($this->emptyText === null) {
        //     $this->emptyText = Yii::t('yii', 'No results found.');
        // }
        if (!($this->widgetId)) {
            $this->widgetId = $this->getId();
        }
        
    }

    public function run()
    {
        $this->registerAssets();
        
        return $this->render('index', ['model' => $this->model]);
    }

    public function registerAssets()
    {
        $view = $this->getView();
        // FeatureAsset::register($view);
    }

}