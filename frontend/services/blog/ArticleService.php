<?php
/**
 * ArticleService
 */
namespace frontend\services\blog;

use yii;
use yii\base\Component;
use yii\helpers\Html;
use frontend\services\fragments\HeaderService;
use yii\helpers\Url;
use frontend\models\BlogArticle;
use common\components\helpers\HtmlMetaHelper;

class ArticleService extends Component{

    public function getSingleArticle($alias){
        $article = BlogArticle::find()
            ->active()
            ->one();

        return $article;
    }

    public function getArticleTags(BlogArticle $article){
        return !$article->hasTags() ? : $article->tags;
    }

    public function getArticleAuthor(BlogArticle $article){
        return !$article->hasAuthor() ? : $article->authorWithProfile;
    }
    
    public function makeArticleMetaTags(BlogArticle $article){
        //Meta tags
        HtmlMetaHelper::putSeoTags([
            'title' => $article->metaTitle,
            'description' => $article->metaDesc,
            // 'keywords' => $article->metaKeywords,
            'canonical' => Url::canonical(),
        ]);
        
        HtmlMetaHelper::putFacebookMetaTags([
            'og:url'        => Url::canonical(),
            'og:type'       => 'website',
            'og:title'      => $article->metaTitle,
            'og:description'=> $article->metaDesc,
            'og:image'      => Url::to("@blogPostHeaderPicsWeb/$article->id/middle/$article->img", true),
            'fb:app_id'=> '1811670458869631',//для статистики по переходам
//            'og:locale'=> 'ru_UKR',
        ]);
        
        HtmlMetaHelper::putTwitterMetaTags([
            'twitter:site'        => Url::canonical(),
            'twitter:title'       => $article->metaTitle,
            'twitter:description' => $article->metaDesc,
            'twitter:creator'     => 'Coderius',
            'twitter:image:src'      => Url::to("@blogPostHeaderPicsWeb/$article->id/middle/$article->img", true),
            'twitter:card'=> 'summary',

        ]);
    }

}


?>