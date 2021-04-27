<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use backend\models\Widgets;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Widgets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widgets-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(Widgets::widgetTypes(), ['prompt' => 'Выбрать ...']) ?>
   
    <?= $form->field($model, 'descriptions')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
