<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SlickAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/slick';
    public $baseUrl = '@web/Libraries/slick';
    public $css = [
        'slick.css',
        'slick-theme.css'
    ];
    public $js = [
        'slick.min.js'
    ];

    public $depends = [];
}
