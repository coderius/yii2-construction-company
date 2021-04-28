<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetBloglist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-bloglist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widgetId')->textInput() ?>

    <?= $form->field($model, 'typeContent')->dropDownList([ 'last' => 'Last', 'popular' => 'Popular', 'random' => 'Random', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
