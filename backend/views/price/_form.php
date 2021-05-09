<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\PriceCategory;
use common\widgets\IosStyleToggleSwitch\IosStyleToggleSwitchWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Price */
/* @var $form yii\widgets\ActiveForm */


// var_dump(ArrayHelper::map(PriceCategory::find()->all(), 'id', 'header'));
?>

<div class="price-form m-2">

    <?php $form = ActiveForm::begin([
        'action' => $formAction,
        'enableAjaxValidation' => true,
        'options' => [
            'class' => $formClass,
        ],
    ]); ?>

    <?php //echo $form->field($model, 'categoryId')->textInput() ?>

    <?= $form->field($model, 'categoryId')
            ->dropDownList(
                ArrayHelper::map(PriceCategory::find()->all(), 'id', 'header'),
                    [
                        'prompt'=>'Выбрать страницу'
                    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'equal')->textInput(['maxlength' => true]) ?>

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
