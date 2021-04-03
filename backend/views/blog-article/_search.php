<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BlogArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'metaTitle') ?>

    <?= $form->field($model, 'metaDesc') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'header1') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'viewCount') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'updatedBy') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
