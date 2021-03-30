<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AnimateAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/animate';
    public $baseUrl = '@web/Libraries/animate';
    public $css = [
        'animate.min.css'
    ];
    public $js = [];

    public $depends = [];
}
