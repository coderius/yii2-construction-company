<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Prices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Price'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'categoryId',
            'name',
            'cost',
            'unit',
            //'equal',
            //'sortOrder',
            //'status',
            //'createdAt',
            //'updatedAt',
            //'createdBy',
            //'updatedBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
