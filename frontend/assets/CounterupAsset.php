<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CounterupAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/counterup';
    public $baseUrl = '@web/Libraries/counterup';
    
    public $js = [
        'counterup.min.js'
    ];

    public $depends = [];
}
