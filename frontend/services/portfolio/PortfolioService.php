<?php
/**
 * ArticleService
 */
namespace frontend\services\portfolio;

use yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use frontend\services\fragments\HeaderService;
use yii\helpers\Url;
use frontend\models\Tag;
use common\components\helpers\HtmlMetaHelper;
use frontend\controllers\BaseController;
use frontend\models\PortfolioCategory;
use frontend\models\sidebar\Sidebar;
use yii\db\Expression;

class PortfolioService{

    public function __construct()
    {
        
    }
    
    public function activeCategoriesCount(){
        return PortfolioCategory::find()->active()->count();
    }

    public function activeCategoriesTags(){
        $items = Tag::find()
            ->alias('t')
            ->select(['t.header', 't.alias', 'COUNT(c.id) AS surrogatePortfolioCategoriesCount'])
            ->joinWith(['portfolioCategories c' => function ($query) {
                                $query->onCondition(['c.status' => PortfolioCategory::ACTIVE_STATUS]);
                            }
            ])
            ->groupBy('t.id')
            ->orderBy(['t.createdAt' => SORT_DESC])
            ->all();

        return $items;
    }

    public function makeMetaTags($data = null){
        if(null === $data){
            $data = [
                'metaTitle' => 'Наше портфолио',
                'description' => 'Портфолио наших работ. Фото работ по ремонту и отделке квартир.',
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

    public static function isCurrentUrlStyle($url){
        // var_dump($url === Url::to('') ? 'filter-active' : '');die;

        return $url === Url::to('') ? 'filter-active' : '';
    }

}


?>