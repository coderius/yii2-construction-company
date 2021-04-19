<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Price */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-form m-2">
<?php Pjax::begin(['id' => 'form-create', 'timeout' => 2000,]) ?>
    <?php $form = ActiveForm::begin([
        'id' => $formIdSelector,
        'action' => $formAction,
        'options' => ['data-pjax' => true]
    ]); ?>

    <?= $form->field($model, 'categoryId')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'equal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success', 'id' => 'form-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
