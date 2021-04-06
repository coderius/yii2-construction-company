<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use backend\models\BlogArticle;
use yii\helpers\ArrayHelper;

Bootstrap4GlyphiconsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blog Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <span class="glyphicon glyphicon-pencil"></span> -->
<div class="blog-article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Blog Article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=> function ($model, $key, $index, $grid){
            $class = $index % 2 ?'odd':'even';
            return [
                'key'=> $key,
                'index'=> $index,
                'class'=> $class
            ];
        },

        'columns' => [

            [
                'class' => 'yii\grid\CheckboxColumn', 
    //            'checkboxOptions' => function($model) {
    //                return ['value' => $model->Your_unique_id];
    //            },
            ],

            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'font-size: 100%; color: #d2d2d2;']
            ],

            'id',
            'alias',


            // 'metaTitle',
            [
                'attribute' => 'metaTitle',
                'format' => 'raw',
                'value' => function ($model) {
                        return "<a target='_blank' href=".\Yii::$app->urlManagerFrontend->createUrl(["/blog/article/{$model->alias}"]).">".$model->metaTitle."</a>";
                },
            ],

            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => function ($model) {
                        return Html::img("@blogPostHeaderPicsWeb/{$model->id}/small/{$model->img}", ['alt'=> $model->metaTitle,'title'=> $model->metaTitle, 'style'=>'width: 100px;']);
                },
            ],

            'metaDesc',
            // 'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    BlogArticle::DISABLED_STATUS => BlogArticle::$statusesName[BlogArticle::DISABLED_STATUS],
                    BlogArticle::ACTIVE_STATUS =>  BlogArticle::$statusesName[BlogArticle::ACTIVE_STATUS],
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === BlogArticle::ACTIVE_STATUS;
                    return Html::tag('span',
                        $active ? 
                            BlogArticle::$statusesName[BlogArticle::ACTIVE_STATUS] 
                            : 
                            BlogArticle::$statusesName[BlogArticle::DISABLED_STATUS],
                        [
                            'class' => 'badge badge-' . ($active ? 'success' : 'danger'),
                        ]
                    );
                },
            ],

            [
                'attribute' => 'category',
                'format' => 'raw',
                'label' => 'Категория',
                // 'value' => 'category.metaTitle',
                'value' => function ($model, $key, $index, $column) {
                    if($c = $model->category){
                        return $c->metaTitle;
                    }
                    return null;
                },
            ],

            [
                'contentOptions' => ['title' => 'Дата создания', 'style' => 'font-size: 12px'],
                'attribute' => 'createdAt',
                'format' => ['datetime', 'php:d F (D.) Yг. в Hч.iм.'],
            ],

            [
                'contentOptions' => ['title' => 'Дата создания', 'style' => 'font-size: 12px'],
                'attribute' => 'updatedAt',
                'format' => ['datetime', 'php:d F (D.) Yг. в Hч.iм.'],
            ],



            //'header1',
            //'text:ntext',
            //'img:ntext',
            'viewCount',
            //'createdAt',
            //'updatedAt',
            // 'createdBy',
            [
                'attribute' => 'createdBy',
                'format' => 'raw',
                'filter' => ArrayHelper::map(common\models\user\User::find()->all(), 'id', 'username'),
                'value' => 'createdBy0.username',
            ],

            // 'updatedBy',
            [
                'attribute' => 'updatedBy',
                'format' => 'raw',
                'filter' => ArrayHelper::map(common\models\user\User::find()->all(), 'id', 'username'),
                'value' => 'updatedBy0.username',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
