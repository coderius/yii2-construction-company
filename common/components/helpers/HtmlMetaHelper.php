<?php

namespace common\components\helpers;

use yii;
use yii\base\Component;
use yii\helpers\Html;
use frontend\services\fragments\HeaderService;
use yii\helpers\Url;


class HtmlMetaHelper extends Component{
    
    public $currentFacebookOgUrl = null;


    public function __construct($config = [])
    {
        parent::__construct($config);
        
    }
    
    public function init(){
        parent::init();
//        $this->content= 'Текст по умолчанию';
    }
    
    public static function putSeoTags($tags){
        if( isset($tags['title']) ){
            \Yii::$app->view->title = $tags['title'];
        }
        
        if( isset($tags['description']) ){
            \Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $tags['description'],
            ], 'description');
        }
        
        if( isset($tags['keywords']) ){
            \Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $tags['keywords'],
            ], 'keywords');
        }
        
        if( isset($tags['canonical']) ){
            \Yii::$app->view->registerLinkTag([ 'rel' => 'canonical', 'href' => $tags['canonical'] ]);
        }
        
    }
    
    public static function putFacebookMetaTags($tags){
        
        foreach($tags as $prop => $content){
            \Yii::$app->view->registerMetaTag([
                'property' => $prop,
                'content' => $content,
            ], $prop);
        }
    }
    
    public static function putTwitterMetaTags($tags){
        
        foreach($tags as $name => $content){
            \Yii::$app->view->registerMetaTag([
                'name' => $name,
                'content' => $content,
            ], $name);
        }
    }
    
    public static function putGooglePlusMetaTags($tags){
        
        foreach($tags as $itemprop => $content){
            \Yii::$app->view->registerMetaTag([
                'itemprop' => $itemprop,
                'content' => $content,
            ], "google:" . $itemprop);
        }
    }
    
    
    
    public function getCurrentFacebookOgUrl(){
        if(null === $this->currentFacebookOgUrl){
            $this->currentFacebookOgUrl = Url::canonical();
        }
        
        return $this->currentFacebookOgUrl;
    }
    
}
