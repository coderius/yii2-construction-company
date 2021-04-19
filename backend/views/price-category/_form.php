<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\widgets\IosStyleToggleSwitch\IosStyleToggleSwitchWidget;
/* @var $this yii\web\View */
/* @var $model backend\models\PriceCategory */
/* @var $form yii\widgets\ActiveForm */

$targetId = Html::getInputId($model, 'header');
$elId = Html::getInputId($model, 'alias');

if(\Yii::$app->controller->action->id == 'create')
{
    \common\components\helpers\InputHelper::inputTranclite($targetId, $elId, $this);
}
?>

<div class="price-category-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

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
