<?php

namespace backend\controllers;

use Yii;
use backend\models\PriceCategory;
use backend\models\PriceCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PriceCategoryController implements the CRUD actions for PriceCategory model.
 */
class PriceCategoryController extends BaseAdminController
{
    
    /**
     * Lists all PriceCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PriceCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PriceCategory model.
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
     * Creates a new PriceCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PriceCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PriceCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSortList()
    {
        if(\Yii::$app->request->isAjax){
            $ids = Yii::$app->request->post('ids');
            
            if($ids){
                $model = PriceCategory::find()->where(['in', 'id', $ids])->orderSortOrder()->all();
                
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
                    $model = PriceCategory::find()->where(['id' => $id])->one();
                    $model->sortOrder = $order;
                    $saved = $model->save();
                    $order++;
                }
                
                return $saved ? $this->asJson(['success' => 'Ok!']) : $this->asJson(['error' => 'Not saved data!']);
            }
            
        }
    }

    /**
     * Deletes an existing PriceCategory model.
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
     * Finds the PriceCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PriceCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PriceCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
