<?php

namespace backend\controllers;

use Yii;
use backend\models\WidgetGallery;
use backend\models\WidgetGallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;

/**
 * WidgetGalleryController implements the CRUD actions for WidgetGallery model.
 */
class WidgetGalleryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all WidgetGallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WidgetGallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WidgetGallery model.
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
     * Creates a new WidgetGallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WidgetGallery();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WidgetGallery model.
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
                $model = WidgetGallery::find()->where(['in', 'id', $ids])->orderSortOrder()->all();
                
                $lists = $this->renderAjax('_sort', [
                    'model' => $model,
                ]);
                return $lists;
            }
            else{
                return $this->asJson(['empty' => '???????????? ???? ?????????????? ?????? ????????????????????!']);
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
                    $model = WidgetGallery::find()->where(['id' => $id])->one();
                    $model->sortOrder = $order;
                    $saved = $model->save();
                    $order++;
                }
                
                return $saved ? $this->asJson(['success' => 'Ok!']) : $this->asJson(['error' => 'Not saved data!']);
            }
            
        }
    }


    /**
     * Deletes an existing WidgetGallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $dir = Yii::getAlias('@widgetGalleryPicsPath/'.$id);
        FileHelper::removeDirectory($dir);

        return $this->redirect(['index']);
    }

    /**
     * Finds the WidgetGallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WidgetGallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WidgetGallery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
