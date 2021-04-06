<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Contacts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contacts-view">

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
            'title',
            'data',//json data decoded in afterFind in model
            // [
            //     'attribute' => 'data',
            //     // 'format' => 'raw',
            //     'value'  => call_user_func(
            //                 function ($model){
                                
            //                     return $model->getDecodeData();
                    
            //                 }, $model
                        
            //             ),
            // ],
            'icon1:ntext',
            'icon2:ntext',
            'sortOrder',
            'status',
            'createdAt',
            'updatedAt',
            'createdBy',
            'updatedBy',
        ],
    ]) ?>

</div>
