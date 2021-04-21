<?php
/**
 * ArticleService
 */
namespace frontend\services\price;

use yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\helpers\HtmlMetaHelper;
use yii\db\Expression;
use frontend\models\PriceCategory;
use frontend\models\Price;

class PriceService{

    public function __construct()
    {
        
    }
    
    

    public function categoriesAndItems(){
        $price = PriceCategory::find()
            ->alias('pc')
            ->where(['pc.status' => PriceCategory::ACTIVE_STATUS])
            ->joinWith(['prices p' => function ($query) {
                    $query->onCondition(['p.status' => Price::ACTIVE_STATUS])->orderBy(['p.sortOrder' => SORT_ASC]);
                }
            ])
            ->groupBy('pc.id')
            ->orderBy(['pc.sortOrder' => SORT_ASC])
            ->all();

        return $price;
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

    

}


?>