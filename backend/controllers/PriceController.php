<?php

namespace backend\controllers;

use Yii;
use backend\models\Price;
use backend\models\PriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PriceController implements the CRUD actions for Price model.
 */
class PriceController extends BaseAdminController
{
    
    public function beforeAction($action)
    {
        // $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    /**
     * Lists all Price models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Price();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Price model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Price model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Price();

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->validate()){
                return ['success' => $model->save()];
            }else{
                return ['validation' => $model->getErrors()];
            }
        }

        if(\Yii::$app->request->isAjax){
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['index']);
        // }

        // echo $model->getErrors();
        // die;

        // // return $this->render('create', [
        // //     'model' => $model,
        // // ]);
    }

    /**
     * Updates an existing Price model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->validate()){
                return ['success' => $model->save()];
            }else{
                return ['validation' => $model->getErrors()];
            }
        }

        if(\Yii::$app->request->isAjax){
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionSortList()
    {
        if(\Yii::$app->request->isAjax){
            $ids = Yii::$app->request->post('ids');
            
            if($ids){
                $model = Price::find()->where(['in', 'id', $ids])->orderSortOrder()->all();
                
                $lists = $this->renderAjax('_sort', [
                    'model' => $model,
                ]);
                return $lists;
            }
            else{
                return $this->asJson(['empty' => 'Ничего не выбрано для сортировки!']);
            }
        }
    }

    public function actionSortSave()
    {
        if(\Yii::$app->request->isAjax){
            $items = Yii::$app->request->post('items');
            // preg_match_all("/(\d+)/", $items, $output);
            // return $this->asJson($output[1]);

            if($items){
                preg_match_all("/(\d+)/", $items, $output);
                $ids = $output[1];
                $order = 1;
                $saved = false;
                foreach($ids as $id){
                    $model = Price::find()->where(['id' => $id])->one();
                    $model->sortOrder = $order;
                    $saved = $model->save();
                    $order++;
                }
                
                return $saved ? $this->asJson(['success' => 'Ok!']) : $this->asJson(['error' => 'Not saved data!']);
            }
            
        }
    }

    /**
     * Deletes an existing Price model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Price model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Price the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Price::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
