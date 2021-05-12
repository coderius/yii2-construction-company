<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use yii\helpers\ArrayHelper;
use backend\models\PortfolioCategory;
use yii\bootstrap4\BootstrapAsset;

BootstrapAsset::register($this);
Bootstrap4GlyphiconsAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PortfolioCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Portfolio Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-category-index m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Portfolio Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
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
                        return "<a target='_blank' href=".\Yii::$app->urlManagerFrontend->createUrl(["/portfolio/category/{$model->alias}"]).">".$model->metaTitle."</a>";
                },
            ],
            'metaDesc',
            'headerShort',
            //'headerLong',
            //'sortOrder',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    PortfolioCategory::DISABLED_STATUS => PortfolioCategory::$statusesName[PortfolioCategory::DISABLED_STATUS],
                    PortfolioCategory::ACTIVE_STATUS =>  PortfolioCategory::$statusesName[PortfolioCategory::ACTIVE_STATUS],
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === PortfolioCategory::ACTIVE_STATUS;
                    return Html::tag('span',
                        $active ?
                            PortfolioCategory::$statusesName[PortfolioCategory::ACTIVE_STATUS] 
                            :
                            PortfolioCategory::$statusesName[PortfolioCategory::DISABLED_STATUS],
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
