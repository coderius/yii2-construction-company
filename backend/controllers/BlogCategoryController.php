<?php

namespace backend\controllers;

use Yii;
use backend\models\BlogCategory;
use backend\models\BlogCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\BlogArticleBlogCategory;
use yii\helpers\FileHelper;

/**
 * BlogCategoryController implements the CRUD actions for BlogCategory model.
 */
class BlogCategoryController extends BaseAdminController
{
    
    public function actions()
    {
        return [
                'uploadImgTinymce' => [
                    'class' => 'backend\components\actions\blogCategories\AjaxUploadImgTinymceAction',
                ],
                'deleteImgTinymce' => [
                    'class' => 'backend\components\actions\blogCategories\AjaxDeleteImgTinymceAction',
                ],
                // 'uploadImgArticleHeading' => [
                //     'class' => 'backend\components\actions\blog\AjaxUploadImgArticleHeadingAction',
                // ],
                // 'deleteImgArticleHeading' => [
                //     'class' => 'backend\components\actions\blog\AjaxDeleteImgArticleHeadingAction',
                // ],
        ];
    }

    /**
     * Lists all BlogCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogCategory model.
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
     * Creates a new BlogCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BlogCategory model.
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

    /**
     * Deletes an existing BlogCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->enableCsrfValidation = false;
        $this->findModel($id)->delete();

        BlogArticleBlogCategory::deleteAll(['categoryId' => $id]);
        
        //???????? ?? ?????????? ?????????????????????? ?? ????????????
        //?????? ???? ??????????????????????
        // $dir = Yii::getAlias('@blogCatTextPicsPath/'.$id);
        // FileHelper::removeDirectory($dir);

        return $this->redirect(['index']);
    }

    /**
     * Finds the BlogCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
