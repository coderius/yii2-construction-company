<?php

namespace backend\controllers;

use Yii;
use backend\models\BlogArticle;
use backend\models\BlogArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\BlogCategory;
use backend\models\Tag;
use backend\models\BlogArticleBlogCategory;
use backend\models\BlogArticleTag;
use yii\helpers\FileHelper;

/**
 * BlogArticleController implements the CRUD actions for BlogArticle model.
 */
class BlogArticleController extends BaseAdminController
{
    

    public function actions()
    {
        return [
                'uploadImgTinymce' => [
                    'class' => 'backend\components\actions\blog\AjaxUploadImgTinymceAction',
                ],
                'deleteImgTinymce' => [
                    'class' => 'backend\components\actions\blog\AjaxDeleteImgTinymceAction',
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
     * Lists all BlogArticle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogArticle model.
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
     * Creates a new BlogArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogArticle();

        $mapCategories = ArrayHelper::map(BlogCategory::find()->all(), 'id', 'metaTitle');
        $mapTags = ArrayHelper::map(Tag::find()->all(), 'id', 'metaTitle');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', compact(
            'model',
            'mapCategories',
            'mapTags'
            )
        );
    }

    /**
     * Updates an existing BlogArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $mapCategories = ArrayHelper::map(BlogCategory::find()->all(), 'id', 'metaTitle');
        $mapTags = ArrayHelper::map(Tag::find()->all(), 'id', 'metaTitle');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', compact(
            'model',
            'mapCategories',
            'mapTags'
            )
        );
    }

    /**
     * Deletes an existing BlogArticle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->enableCsrfValidation = false;
        $this->findModel($id)->delete();

        BlogArticleBlogCategory::deleteAll(['articleId' => $id]);
        BlogArticleTag::deleteAll(['articleId' => $id]);
        
        $dir = Yii::getAlias('@blogPostHeaderPicsPath/'.$id);
        FileHelper::removeDirectory($dir);

        return $this->redirect(['index']);

    }

    /**
     * Finds the BlogArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogArticle::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
