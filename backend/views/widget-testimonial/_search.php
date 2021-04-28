<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetTestimonialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-testimonial-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'widgetId') ?>

    <?= $form->field($model, 'sortOrder') ?>

    <?= $form->field($model, 'img') ?>

    <?= $form->field($model, 'header1') ?>

    <?php // echo $form->field($model, 'header2') ?>

    <?php // echo $form->field($model, 'text') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
