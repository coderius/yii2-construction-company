<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\helpers\DateTimeHelper;
use backend\models\Page;

/* @var $this yii\web\View */
/* @var $model backend\models\PriceCategory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Price Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="price-category-view m-2">

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
            'alias',
            'header',
            'description:ntext',
            'icon',
            'status',
            'sortOrder',
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
