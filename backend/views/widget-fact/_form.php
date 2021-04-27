<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetFact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-fact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widgetId')->textInput() ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
