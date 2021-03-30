<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FlaticonAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/flaticon/font';
    public $baseUrl = '@web/Libraries/flaticon/font';
    public $css = [
        'flaticon.css'
    ];
    public $js = [];

    public $depends = [];
}
