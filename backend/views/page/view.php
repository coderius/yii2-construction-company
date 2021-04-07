<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\helpers\DateTimeHelper;
use backend\models\Page;
/* @var $this yii\web\View */
/* @var $model backend\models\Page */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-view">

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
                                $url = \Yii::$app->urlManagerFrontend->createUrl(["page/{$model->alias}"]);
                                $link = Html::a($model->alias, $url, ["class"=>"label label-default", 'target' => '_blank']);
                                return $link;
                            }, $model
                        ),
            ],
            'metaTitle',
            'metaDesc',
            // 'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value'  => Page::$statusesName[$model->status],
            ],
            'storyHeader1',
            'storyHeader2',
            'storyText:ntext',
            // 'storyImg:ntext',
            [
                'attribute' => 'storyImg',
                'format' => 'raw',
                'value'  => Html::img("@pageHeaderPicsWeb/{$model->id}/small/{$model->storyImg}", ['alt'=> $model->storyHeader1,'title'=> $model->storyHeader1, 'style'=>'']),
            ],
            'storyButtonTitle',
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
