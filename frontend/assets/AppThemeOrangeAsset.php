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
        'css/style-app.css',
    ];

    public $js = [

    ];

    
    public function init()
    {
        $this->setThemeName(self::THEME_NAME);
        
        parent::init();
    }

    

}
