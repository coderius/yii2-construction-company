<?php

namespace backend\controllers;

use Yii;
use backend\models\PortfolioCategory;
use backend\models\PortfolioCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\Tag;
use backend\models\PortfolioCategoryTag;

/**
 * PortfolioCategoryController implements the CRUD actions for PortfolioCategory model.
 */
class PortfolioCategoryController extends BaseAdminController
{
    
    /**
     * Lists all PortfolioCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PortfolioCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PortfolioCategory model.
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
     * Creates a new PortfolioCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PortfolioCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $mapTags = ArrayHelper::map(Tag::find()->all(), 'id', 'metaTitle');

        return $this->render('create', [
            'model' => $model,
            'mapTags' => $mapTags
        ]);
    }

    /**
     * Updates an existing PortfolioCategory model.
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

        $mapTags = ArrayHelper::map(Tag::find()->all(), 'id', 'metaTitle');

        return $this->render('update', [
            'model' => $model,
            'mapTags' => $mapTags
        ]);
    }

    /**
     * Deletes an existing PortfolioCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        PortfolioCategoryTag::deleteAll(['portfolioCategoryId' => $id]);
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the PortfolioCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PortfolioCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PortfolioCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
