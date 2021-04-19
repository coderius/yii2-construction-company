<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use yii\helpers\ArrayHelper;
use backend\models\PriceCategory;

Bootstrap4GlyphiconsAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PriceCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Price Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-category-index m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Price Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn', 
            ],

            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'font-size: 100%; color: #d2d2d2;']
            ],

            'id',
            'alias',
            'header',
            'description:ntext',
            'icon',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    PriceCategory::DISABLED_STATUS => PriceCategory::$statusesName[PriceCategory::DISABLED_STATUS],
                    PriceCategory::ACTIVE_STATUS =>  PriceCategory::$statusesName[PriceCategory::ACTIVE_STATUS],
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === PriceCategory::ACTIVE_STATUS;
                    return Html::tag('span',
                        $active ? 
                            PriceCategory::$statusesName[PriceCategory::ACTIVE_STATUS] 
                            : 
                            PriceCategory::$statusesName[PriceCategory::DISABLED_STATUS],
                        [
                            'class' => 'badge badge-' . ($active ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
            //'sortOrder',
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
