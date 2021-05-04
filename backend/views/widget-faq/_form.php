<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use backend\models\Widgets;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetFaq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-faq-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widgetId')
            ->dropDownList(
                ArrayHelper::map(Widgets::find()->where(['type' => Widgets::TYPE_FAQ])->all(), 'id', 'descriptions'),
                    [
                        'prompt'=>'Выбрать категорию'
                    ]); ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
