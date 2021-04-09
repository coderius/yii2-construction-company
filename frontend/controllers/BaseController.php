<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

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

        parent::init();
    }

    public function registerBeforeViewRendered($event)
    {
        $view = $event->sender;
        // $this->setMetaTitle($view);
    }

    // protected function setMetaTitle($view)
    // {
    //     $view->title = $this->makeMetaTitle($view, $this->metaTitle);
    // }

    // public function makeMetaTitle($metaTitle = null){
    //     $title = [];

    //     if ($metaTitle !== null) {
    //         $title[] = $metaTitle;
    //     }

    //     $title[] = Yii::$app->name;
    //     return implode(' | ', $title);
    // }
}
