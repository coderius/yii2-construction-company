<?php
/**
 * ArticleService
 */
namespace frontend\services\widgetLayout;

use yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\WidgetCarousel;
use frontend\models\Widgets;
use common\components\helpers\TextHelper;
use frontend\models\PageWidgets;

class WidgetLayoutService{

    const PAGETYPE_PAGE = 'page';
    
    public function __construct()
    {
        
    }
    //Prepere data for WidgetLayout
    public function getTemplate($pageId, $pageType)
    {
        $template = '';
        if($pageType === self::PAGETYPE_PAGE){
            $model = PageWidgets::find()->where(['pageId' => $pageId])->one();
            if($model){
                $template = $model->template;
            }
            
        }
        return $this->buildTemplate($template);

        // $items = Widgets::find()
        //     ->alias('w')
        //     ->joinWith(['widgetCarousels wc' => function ($query) {
        //             $query;
        //         }
        //     ])
        //     ->orderBy(['wc.sortOrder' => SORT_DESC])
        //     ->where(['w.id' => $widgetId])
        //     ->one();

        // return $items;
    }

    //Return array values id widgets and content mark
    protected function buildTemplate($template){
        if(!$template){
            return ['content'];
        }
        $array = explode(',', $template);
        $result = [];
        foreach($array as $v){
            $item = $v;
            $item = rtrim(ltrim($v, '['), ']');
            $result[] = $item;
        }
        
        return $result;
    }


}


?>