<?php
namespace common\widgets\feature;

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

class FeatureWidget extends Widget
{
    public $widgetId;
    
    
    public function init()
    {
        parent::init();
        
        // if ($this->query === null) {
        //     throw new InvalidConfigException('The "query" property must be set.');
        // }
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
        
        return $this->render('index', []);
    }

    public function registerAssets()
    {
        $view = $this->getView();
        // FeatureAsset::register($view);
    }

}