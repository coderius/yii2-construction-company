<?php
//AjaxUploadImgArticleHeadingAction
namespace backend\components\actions\blog;

use yii;
use yii\base\Action;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box; 
use yii\imagine\Gd;
use Imagine\Image\Point;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\base\DynamicModel;
use yii\web\Response;

class AjaxUploadImgArticleHeadingAction extends Action
{
    public function run()
    {
        return $this->hendler();
    }

    private function hendler()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isPost) {
            //{ "location": "folder/sub-folder/new-location.png" }
            
            $file = UploadedFile::getInstanceByName('image');
            return $file;
        }
    }
}