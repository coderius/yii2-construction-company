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
use frontend\models\SearchingSiteModel;
use frontend\models\SuggestersSearch;
use yii\elasticsearch\Query;
use yii\data\ActiveDataProvider;

class SearchService implements ISearchService{

    // private $sidebarRepo;

    // public function __construct(SidebarRepo $sidebarRepo)
    // {
    //     $this->sidebarRepo = $sidebarRepo;
    // }
    
    public function providerSuggesters($query){
        $searchModel = new SuggestersSearch();
        $provider = $searchModel->search($query);
        return $provider;
    }

    public function providerSearch($queryString){
        $searchModel = new SearchingSiteModel();
        $provider = $searchModel->search($queryString);
        return $provider;
    }

    public function makeMetaTags($queryString){
        $data = [
            'metaTitle' => 'Результаты поиска по запросу: ' . $queryString,
            'description' => 'Все результаты поиска по запросу: ' . $queryString,
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