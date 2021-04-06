<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use backend\models\BlogCategory;
use yii\helpers\ArrayHelper;

Bootstrap4GlyphiconsAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blog Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Blog Category'), ['create'], ['class' => 'btn btn-success']) ?>
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
                        return "<a target='_blank' href=".\Yii::$app->urlManagerFrontend->createUrl(["/blog/category/{$model->alias}"]).">".$model->metaTitle."</a>";
                },
            ],
            'metaDesc',
            'header',
            //'text:ntext',
            'sortOrder',
            //'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    BlogCategory::DISABLED_STATUS => BlogCategory::$statusesName[BlogCategory::DISABLED_STATUS],
                    BlogCategory::ACTIVE_STATUS =>  BlogCategory::$statusesName[BlogCategory::ACTIVE_STATUS],
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === BlogCategory::ACTIVE_STATUS;
                    return Html::tag('span',
                        $active ? 
                            BlogCategory::$statusesName[BlogCategory::ACTIVE_STATUS] 
                            : 
                            BlogCategory::$statusesName[BlogCategory::DISABLED_STATUS],
                        [
                            'class' => 'badge badge-' . ($active ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
            'viewCount',
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
