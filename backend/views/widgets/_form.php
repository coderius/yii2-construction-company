<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Widgets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widgets-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList([ 'widget_carousel' => 'Widget carousel', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'descriptions')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
