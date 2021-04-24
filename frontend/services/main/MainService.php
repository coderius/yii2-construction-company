<?php
/**
 * ArticleService
 */
namespace frontend\services\main;

use yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\helpers\HtmlMetaHelper;
use yii\db\Expression;
use frontend\models\Page;

class MainService{

    public function __construct()
    {
        
    }
    
    public function makeHome(){
        $page = Page::find()->where(['isHome' => 1])->one();

        return $page;
    }

    public function makeMetaTags($data = null){
        if(null === $data){
            $data = [
                'metaTitle' => 'Наш сайт по ремонту квартир',
                'description' => 'Сайт по ремонту квартир. Как мелкий ремон, так и под ключ.',
            ];
        }
        
        //Meta tags
        HtmlMetaHelper::putSeoTags([
            'title' => $data['metaTitle'],
            'description' => $data['description'],
            // 'keywords' => $article->metaKeywords,
            'canonical' => Url::canonical(),
        ]);
        
        HtmlMetaHelper::putFacebookMetaTags([
            'og:url'        => Url::canonical(),
            'og:type'       => 'website',
            'og:title'      => $data['metaTitle'],
            'og:description'=> $data['description'],
            // 'og:image'      => Url::to("@blogPostHeaderPicsWeb/$article->id/middle/$article->img", true),
            'fb:app_id'=> '1811670458869631',//для статистики по переходам
//            'og:locale'=> 'ru_UKR',
        ]);
        
        HtmlMetaHelper::putTwitterMetaTags([
            'twitter:site'        => Url::canonical(),
            'twitter:title'       => $data['metaTitle'],
            'twitter:description' => $data['description'],
            'twitter:creator'     => 'Master',
            // 'twitter:image:src'      => Url::to("@blogPostHeaderPicsWeb/$article->id/middle/$article->img", true),
            'twitter:card'=> 'summary',

        ]);
    }

    

}


?>