<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class WowAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/wow';
    public $baseUrl = '@web/Libraries/wow';
    
    public $js = [
        'wow.min.js'
    ];

    public $depends = [];
}
