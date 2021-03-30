<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class IsotopeAsset extends AssetBundle
{
    public $basePath = '@webroot/Libraries/isotope';
    public $baseUrl = '@web/Libraries/isotope';
    
    public $js = [
        'isotope.pkgd.min.js'
    ];

    public $depends = [];
}
