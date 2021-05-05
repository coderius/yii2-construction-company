<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Widgets;
use dosamigos\fileinput\BootstrapFileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetBloglist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-bloglist-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widgetId')
            ->dropDownList(
                ArrayHelper::map(Widgets::find()->where(['type' => Widgets::TYPE_BLOGLIST])->all(), 'id', 'descriptions'),
                    [
                        'prompt'=>'Выбрать категорию'
                    ]);
    ?>

    <?= $form->field($model, 'typeContent')->dropDownList([ 'last' => 'Last', 'popular' => 'Popular', 'random' => 'Random', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
