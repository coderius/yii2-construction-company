<?php
/**
 * ArticleService
 */
namespace frontend\services\widgets;

use yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\WidgetCarousel;
use common\components\helpers\TextHelper;


class CarouselService{

    public function __construct()
    {
        
    }
    
    public function getPopularPosts()
    {
        $items = WidgetCarousel::find()
            ->orderBy(['viewCount' => SORT_DESC])
            ->all();

        return $items;
    }


}


?>