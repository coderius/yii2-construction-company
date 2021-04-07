<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\widgets\IosStyleToggleSwitch\IosStyleToggleSwitchWidget;
use yii\helpers\ArrayHelper;
use backend\models\MenuTop;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuTop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-top-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parentId')
            ->dropDownList($model->selectParentId(),['prompt'=>'Not set']); ?>

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
