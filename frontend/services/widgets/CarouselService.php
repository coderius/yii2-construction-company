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
    
    public function getEntities()
    {
        $items = WidgetCarousel::find()
            ->orderBy(['sortOrder' => SORT_DESC])
            ->all();

        return $items;
    }


}


?>