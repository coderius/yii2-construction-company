<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;

Bootstrap4GlyphiconsAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserManageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Manages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-manage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Manage'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'role',
            'username',
            'authKey',
            'password',
            //'passwordResetToken',
            //'email:email',
            //'status',
            //'createdAt',
            //'updatedAt',
            //'verificationToken',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
