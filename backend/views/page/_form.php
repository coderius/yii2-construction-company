<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metaTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metaDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'storyHeader1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'storyHeader2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'storyText')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'storyImg')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'storyButtonTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'createdAt')->textInput() ?>

    <?= $form->field($model, 'updatedAt')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?>

    <?= $form->field($model, 'updatedBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
