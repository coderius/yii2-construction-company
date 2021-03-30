<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class OwlcarouselAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/owlcarousel';
    public $baseUrl = '@web/Libraries/owlcarousel';
    public $css = [
        'assets/owl.carousel.min.css'
    ];
    public $js = [
        'owl.carousel.min.js'
    ];

    public $depends = [];
}
