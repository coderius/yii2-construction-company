<?php
/**
 * ArticleService
 */
namespace frontend\services\widgets;

use yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\BlogArticle;
use common\widgets\owlCarousel\entities\Meta;
use common\widgets\owlCarousel\entities\Header;
use common\widgets\owlCarousel\entities\Image;
use common\widgets\owlCarousel\entities\OwlCarousel;
use common\widgets\owlCarousel\entities\OwlCarouselItem;
use common\components\helpers\TextHelper;

class CarouselService{

    public function __construct()
    {
        
    }
    
    public function getPopularPosts()
    {
        $items = BlogArticle::find()
            ->active()
            ->with([
                'createdBy0' => function ($query) {
                    $query->select(['id', 'username']);
                }
                , 
                'category' => function ($query) {
                    $query->select(['id', 'header', 'alias']);
                }
            ])
            ->limit(6)
            ->orderBy(['viewCount' => SORT_DESC])
            ->all();

        return $items;
    }

    public function makeEntity(){
        $posts = $this->getPopularPosts();
        $carousel = new OwlCarousel();
        $carousel->setTitle("Еще по теме...");

        foreach($posts as $post){
            $item = new OwlCarouselItem();
            $item->setImage(new Image(Yii::getAlias("@blogPostHeaderPicsWeb/{$post->id}/small/{$post->img}")));
            $header = new Header(
                Url::to(['blog/article', 'alias' => $post->alias]),
                TextHelper::truncate($post->header1, 150)
            );
            $item->setHeader($header);
            $item->addMeta(new Meta(Url::to(['#']), $post->createdBy0->username));
            $item->addMeta(new Meta(Url::to(['blog/category', 'alias' => $post->category->alias]), $post->category->header));
            $carousel->addItem($item);
        }
        
        return $carousel;

    }

}


?>