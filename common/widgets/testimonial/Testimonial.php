<?php

namespace common\widgets\testimonial;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class TestimonialAsset extends AssetBundle
{
    public $sourcePath = (__DIR__ . '/assets');
    
    public $css = [
        // "css/style.css"
    ];

    public $js = [
        // "js/script.js"
    ];
    
    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
    ];
    
    public $depends = [
        // "frontend\assets\OwlcarouselAsset"
    ];
    
    public $publishOptions = [
        'forceCopy' => true,
    ];
    
    public function init()
    {
        
        parent::init();
    }

}


