<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\widgets\IosStyleToggleSwitch\IosStyleToggleSwitchWidget;
use dosamigos\tinymce\TinyMce;
use yii\web\JsExpression;
use yii\helpers\Url;
use dosamigos\fileinput\BootstrapFileInput;

$targetId = Html::getInputId($model, 'metaTitle');
$elId = Html::getInputId($model, 'alias');

if(\Yii::$app->controller->action->id == 'create')
{
    \common\components\helpers\InputHelper::inputTranclite($targetId, $elId, $this);
}

?>

<div class="portfolio-category-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'selectedTags')
            ->dropDownList(
                $mapTags, 
                    [
                        'multiple'=>'multiple','style' => 'height: 100px',
                        // 'prompt'=>'Выбрать теги'
                    ]); ?>
    
    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metaTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metaDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'headerShort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'headerLong')->textInput(['maxlength' => true]) ?>

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
