<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use backend\models\Portfolio;
use yii\helpers\ArrayHelper;

Bootstrap4GlyphiconsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PortfolioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Portfolios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Portfolio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            'categoryId',
            [
                // 'attribute' => 'category',
                'format' => 'raw',
                'label' => 'Категория',
                // 'value' => 'category.metaTitle',
                'value' => function ($model, $key, $index, $column) {
                    // var_dump($model->category);
                    if($c = $model->category){
                        return $c->metaTitle;
                    }
                    return null;
                },
            ],
            'header',
             'description:ntext',
             [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => function ($model) {
                        return Html::img("@portfolioPicsWeb/{$model->id}/small/{$model->img}", ['alt'=> $model->header,'title'=> $model->header, 'style'=>'width: 100px;']);
                },
            ],
            //'imgAlt',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    Portfolio::DISABLED_STATUS => Portfolio::$statusesName[Portfolio::DISABLED_STATUS],
                    Portfolio::ACTIVE_STATUS =>  Portfolio::$statusesName[Portfolio::ACTIVE_STATUS],
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === Portfolio::ACTIVE_STATUS;
                    return Html::tag('span',
                        $active ?
                            Portfolio::$statusesName[Portfolio::ACTIVE_STATUS] 
                            :
                            Portfolio::$statusesName[Portfolio::DISABLED_STATUS],
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
