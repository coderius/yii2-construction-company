<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Page;
use yii\helpers\ArrayHelper;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;

Bootstrap4GlyphiconsAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Page'), ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'metaTitle',
                'format' => 'raw',
                'value' => function ($model) {
                        return "<a target='_blank' href=".\Yii::$app->urlManagerFrontend->createUrl(["/page/{$model->alias}"]).">".$model->metaTitle."</a>";
                },
            ],
            'metaDesc',
            // 'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    Page::DISABLED_STATUS => Page::$statusesName[Page::DISABLED_STATUS],
                    Page::ACTIVE_STATUS =>  Page::$statusesName[Page::ACTIVE_STATUS],
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === Page::ACTIVE_STATUS;
                    return Html::tag('span',
                        $active ? 
                            Page::$statusesName[Page::ACTIVE_STATUS] 
                            : 
                            Page::$statusesName[Page::DISABLED_STATUS],
                        [
                            'class' => 'badge badge-' . ($active ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
            //'storyHeader1',
            //'storyHeader2',
            //'storyText:ntext',
            //'storyImg:ntext',
            [
                'attribute' => 'storyImg',
                'format' => 'raw',
                'value' => function ($model) {
                        return Html::img("@pageHeaderPicsWeb/{$model->id}/small/{$model->storyImg}", ['alt'=> $model->metaTitle,'title'=> $model->metaTitle, 'style'=>'width: 100px;']);
                },
            ],
            //'storyButtonTitle',
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
            [
                'attribute' => 'createdBy',
                'format' => 'raw',
                'filter' => ArrayHelper::map(common\models\user\User::find()->all(), 'id', 'username'),
                'value' => 'createdBy0.username',
            ],

            
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
