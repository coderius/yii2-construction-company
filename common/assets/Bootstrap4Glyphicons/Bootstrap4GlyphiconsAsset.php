<?php

namespace common\assets\Bootstrap4Glyphicons;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Bootstrap4GlyphiconsAsset extends AssetBundle
{
    // public $basePath = '@frontend/web/Libraries/bootstrap4-glyphicons/maps';
    // public $baseUrl = '@frontend-web/Libraries/bootstrap4-glyphicons/maps';
    public $sourcePath = (__DIR__ . '/lib');

    public $css = [
        'bootstrap4-glyphicons/css/bootstrap-glyphicons.min.css'
    ];
    public $js = [];

    public $depends = [];

    public function init()
    {
        parent::init();
        $this->publishOptions['forceCopy'] = true;
    }
}
