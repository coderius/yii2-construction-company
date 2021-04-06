<?php

namespace backend\components\actions\portfoleoPhoto;

use Yii;
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

class AjaxDeleteImgTinymceAction extends Action
{
    public function run()
    {
        return $this->hendler();
    }

    private function hendler()
    {
        $request = Yii::$app->request;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($request->isPost && $request->isAjax) {
            $fullSrc = $request->post('src');
            $ex = explode('/', $fullSrc);
            $src = $ex[count($ex)-1];
            $path = Yii::getAlias("@portfoleoPhotosTextPicsPath/".$src);
            
            if(is_file($path))
                if(FileHelper::unlink($path)){
                    $message = 'Удалено';
                }else{
                    $message = 'Не удалось удалить';
                }
            }else{
                $message = 'Удаляемый объект не является файлом';
            }    

             return ['message' => $message];
    }
}