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
use frontend\models\Widgets;
use common\components\helpers\TextHelper;


class CarouselService{

    public function __construct()
    {
        
    }
    
    public function getEntities($widgetId)
    {
        $items = Widgets::find()
            ->alias('w')
            ->joinWith(['widgetCarousels wc' => function ($query) {
                    $query;
                }
            ])
            ->orderBy(['wc.sortOrder' => SORT_DESC])
            ->where(['w.id' => $widgetId])
            ->one();

        return $items;
    }


}


?>