<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class WaypointsAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/waypoints';
    public $baseUrl = '@web/Libraries/waypoints';
    
    public $js = [
        'waypoints.min.js'
    ];

    public $depends = [];
}
