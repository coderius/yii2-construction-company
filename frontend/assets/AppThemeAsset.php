<?php

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppThemeAsset extends AssetBundle
{
    
    public $basePath;
    public $baseUrl;

    protected $themeName;

    public function init()
    {
        $this->basePath = '@frontend-webroot-themes/' . $this->getThemeName();
        $this->baseUrl  = '@frontend-web-themes/' . $this->getThemeName();
        
        parent::init();
    }

    protected function getThemeName()
    {
        return Yii::$app->params['themes'][$this->themeName]['name'];
    }

    protected function setThemeName($themeName)
    {
        $this->themeName = $themeName;
    }

}
