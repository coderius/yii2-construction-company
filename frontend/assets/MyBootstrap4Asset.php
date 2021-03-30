<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\bootstrap4\BootstrapAsset;

/**
 * Main frontend application asset bundle.
 */
class MyBootstrap4Asset extends BootstrapAsset
{
    public $css = [
        "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css",
    ];

    public $js = [
        "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js",
    ];
}
