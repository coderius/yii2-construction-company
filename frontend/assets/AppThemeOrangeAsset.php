<?php

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppThemeOrangeAsset extends AppThemeAsset
{
    
    const THEME_NAME = 'orange';

    public $css = [
        'css/site.css',
    ];

    public $js = [

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        $this->setThemeName(self::THEME_NAME);
        
        parent::init();
    }

    

}
