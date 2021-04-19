<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Price */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-form m-2">

    <?php $form = ActiveForm::begin([
        'action' => $formAction,
        'enableAjaxValidation' => true,
        'options' => [
            'class' => $formClass,
        ],
    ]); ?>

    <?= $form->field($model, 'categoryId')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'equal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
