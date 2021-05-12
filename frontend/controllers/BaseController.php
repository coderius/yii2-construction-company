<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\MenuTop;
use frontend\services\layout\LayoutService;
use frontend\models\Contacts;
use frontend\models\BlogArticle;

abstract class BaseController extends Controller
{
    /**
     * @var string part of the title to add in the HTML page title. e.g. 'Chennel'
     *             Defaults to [[sectionTitle]], if not explicitly set.
     */
    // public $metaTitle;

    public function init()
    {
        $view = $this->getView();
        $view->on(\yii\web\View::EVENT_BEFORE_RENDER, [$this, 'registerBeforeViewRendered']);
        $this->makeNavBar();
        $this->makeFooter();

        parent::init();
    }

    public function registerBeforeViewRendered($event)
    {
        $view = $event->sender;
        // $this->setMetaTitle($view);
    }

    public function makeNavBar()
    {
        Yii::$app->getView()->params['SiteLayout']['top-bar'] = MenuTop::getTree();
    }

    public function makeFooter()
    {
        Yii::$app->getView()->params['SiteLayout']['footer']['contacts'] = Contacts::find()->all();
        Yii::$app->getView()->params['SiteLayout']['footer']['menu'] = MenuTop::find()->where(['parentId' => 0])->all();
        Yii::$app->getView()->params['SiteLayout']['footer']['blog'] = BlogArticle::find()->orderBy(['createdAt' => SORT_DESC])->limit(4)->all();
    }

    protected function commitCounter($model)
    {
        return $model->updateCounters(['viewCount' => 1]);
    }

    // protected function setMetaTitle($view)
    // {
    //     $view->title = $this->makeMetaTitle($view, $this->metaTitle);
    // }

    // public function makeMetaTitle($metaTitle = null)
    // {
    //     $title = [];

    //     if ($metaTitle !== null) {
    //         $title[] = $metaTitle;
    //     }

    //     $title[] = Yii::$app->name;
    //     return implode(' | ', $title);
    // }
}
