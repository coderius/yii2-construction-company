<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\helpers\DateTimeHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\MenuTop */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu Tops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="menu-top-view">

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
            // 'alias',
            [
                'attribute' => 'alias',
                'format' => 'raw',
                'value'  => call_user_func(
                            function ($model){
                                $url = \Yii::$app->urlManagerFrontend->createUrl(["{$model->alias}"]);
                                $link = Html::a($model->alias, $url, ["class"=>"label label-default", 'target' => '_blank']);
                                return $link;
                            }, $model
                        ),
            ],
            'name',
            'parentId',
            [
                'attribute' => 'parentItem',
                'format' => 'raw',
                'value'  => $model->getParentItem() ? $model->getParentItem()->name : null,
            ],
            'order',
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
