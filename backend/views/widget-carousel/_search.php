<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetCarouselSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-carousel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'header1') ?>

    <?= $form->field($model, 'header2') ?>

    <?= $form->field($model, 'buttonTitle') ?>

    <?= $form->field($model, 'buttonLink') ?>

    <?php // echo $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'imgAlt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
