<?php

namespace backend\components\actions\blogCategories;

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

class AjaxUploadImgTinymceAction extends Action
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
            
            $file = UploadedFile::getInstanceByName('file');
            $model = new DynamicModel(compact('file'));
            $model->addRule('file', 'image', [])->validate();
            
            if ($model->hasErrors()) {
                $result['error'] = $model->getFirstError('file');
                
            }else{
                $path = Yii::getAlias("@blogCatTextPicsPath/");
                $url = Yii::getAlias("@blogCatTextPicsWeb/");
                $model->file->name = uniqid() . '.' . $model->file->extension;
                $resPath = $path . $model->file->name;
                $resUrl = $url . $model->file->name;
                
//                $size = $model->file->size;//вес
                $minSize = 50000;//файл весит 50 кб
                $minwidth = 800;
                
                try {
                    $imagine = Image::getImagine()->open($model->file->tempName);

                    $curWidth = $imagine->getSize()->getWidth();
                    $curHeight = $imagine->getSize()->getHeight();
                    // размер
                    if($curWidth > $minwidth){
                        $resWidth = $minwidth;
                        $resHeight = (($curHeight * $resWidth) / $curWidth);
                    }else{
                        $resWidth = $curWidth;
                        $resHeight = $curHeight;
                    }
                    //для gif изменение размера не работает
                    if($model->file->extension == 'gif'){
                        $imagine->save($resPath, array('animated' => true));
                    }else{
                        $imagine->resize(new Box($resWidth, $resHeight));
                        $imagine->save($resPath, ['quality' => 60]);
                    }
                    $result['location'] = $resUrl;

                }catch(\Exception $e) {
//                    echo 'Message: ' .$e->getMessage();
                    $result['error'] = 'ERROR_CAN_NOT_UPLOAD_FILE';
                }
                
            }
            
            return $result;
            
        } else {
            $result['error'] = 'Only Post is allowed!';
        }

        return $result;
    }
}