<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetSocialgallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-socialgallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widgetId')->textInput() ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?= $form->field($model, 'img')->textInput() ?>

    <?= $form->field($model, 'header1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
