<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetFactSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-fact-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'widgetId') ?>

    <?= $form->field($model, 'sortOrder') ?>

    <?= $form->field($model, 'icon') ?>

    <?= $form->field($model, 'header') ?>

    <?php // echo $form->field($model, 'text') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
