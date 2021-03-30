<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class EasingAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/easing';
    public $baseUrl = '@web/Libraries/easing';
    
    public $js = [
        'easing.min.js'
    ];

    public $depends = [];
}
