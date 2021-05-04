<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\helpers\DateTimeHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Portfolio */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Portfolios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="portfolio-view m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'categoryId',
            [
                'label' => 'Категория',
                'format' => 'raw',
                'value'  => call_user_func(
                            function ($model){ 
                                $res = [];
                                $category = $model->category;
                                $url = \Yii::$app->urlManagerFrontend->createUrl(["portfolio/category/{$category->alias}"]);
                                $res[] = Html::a($category->metaTitle, $url, ["class"=>"label label-default", 'target' => '_blank']);
                                
                                return !empty($res) ? implode(' ', $res) : null;
                                
                            }, $model
                        
                        ),
                
                
            ],
            'header',
            'description:ntext',
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value'  => Html::img("@portfolioPicsWeb/{$model->id}/small/{$model->img}", ['alt'=> $model->imgAlt,'title'=> $model->imgAlt, 'style'=>'']),
            ],
            'imgAlt',
            'status',
            'viewCount',
            [
                'attribute' => 'createdAt',
                'format' => 'raw',
                'value'  => DateTimeHelper::localeDataFormat($model->createdAt),
            ],
            [
                'attribute' => 'updatedAt',
                'format' => 'raw',
                'value'  => DateTimeHelper::localeDataFormat($model->updatedAt),
            ],
            [
                'attribute' => 'createdBy',
                'format' => 'raw',
                'value'  => $model->getCreatedBy0()->username(),
            ],

            [
                'attribute' => 'updatedBy',
                'format' => 'raw',
                'value'  => $model->updatedBy ? $model->getUpdatedBy0()->username() : null,
            ],
        ],
    ]) ?>

</div>
