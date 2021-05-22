<?php
/**
 * ArticleService
 */
namespace frontend\services\search;

use yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\helpers\HtmlMetaHelper;

class SearchService{

    // private $sidebarRepo;

    // public function __construct(SidebarRepo $sidebarRepo)
    // {
    //     $this->sidebarRepo = $sidebarRepo;
    // }
    
    

    public function makeMetaTags($queryString){
        $data = [
            'metaTitle' => 'Результаты поиска по запросу ' . $queryString,
            'description' => 'Все результаты поиска по запросу ' . $queryString,
        ];

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
            'fb:app_id'=> '1811670458869631',//для статистики по переходам
//            'og:locale'=> 'ru_UKR',
        ]);
        
        HtmlMetaHelper::putTwitterMetaTags([
            'twitter:site'        => Url::canonical(),
            'twitter:title'       => $data['metaTitle'],
            'twitter:description' => $data['description'],
            'twitter:creator'     => 'Coderius',
            'twitter:card'=> 'summary',

        ]);
    }

}


?>