<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LightboxAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/lightbox';
    public $baseUrl = '@web/Libraries/lightbox';
    public $css = [
        'css/lightbox.min.css'
    ];
    public $js = [
        'js/lightbox.min.js'
    ];

    public $depends = [];
}
