<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\widgets\IosStyleToggleSwitch\IosStyleToggleSwitchWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'icon1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'icon2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?php 
        echo $form->field($model, 'status')->widget(IosStyleToggleSwitchWidget::class, [
            'type' => IosStyleToggleSwitchWidget::CHECKBOX
        ]);
    ?>

    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
