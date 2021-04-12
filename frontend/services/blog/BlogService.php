<?php
/**
 * ArticleService
 */
namespace frontend\services\blog;

use yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use frontend\services\fragments\HeaderService;
use yii\helpers\Url;
use frontend\models\BlogArticle;
use common\components\helpers\HtmlMetaHelper;
use frontend\controllers\BaseController;
use frontend\models\sidebar\SidebarRepo;
use frontend\models\sidebar\Sidebar;

class BlogService{

    

    public function __construct()
    {
        
    }
    
    public function makeBlogMetaTags($data = null){
        if(null === $data){
            $data = [
                'metaTitle' => 'Весь блог',
                'description' => 'Блог мастеров отделочников. Все материалы для тех, кто интересуется темой ремонта квартир, покупки стройматериалов и прочее.',
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