<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetVideo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-video-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widgetId')->textInput() ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
