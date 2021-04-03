<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blog Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Blog Article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'alias',
            'metaTitle',
            'metaDesc',
            'status',
            //'header1',
            //'text:ntext',
            //'img:ntext',
            //'viewCount',
            //'createdAt',
            //'updatedAt',
            //'createdBy',
            //'updatedBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
