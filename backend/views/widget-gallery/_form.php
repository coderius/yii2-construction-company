<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Widgets;
use dosamigos\fileinput\BootstrapFileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetGallery */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="widget-gallery-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widgetId')
            ->dropDownList(
                ArrayHelper::map(Widgets::find()->where(['type' => Widgets::TYPE_GALLERY])->all(), 'id', 'descriptions'),
                    [
                        'prompt'=>'Выбрать категорию'
                    ]); ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'file')
                ->fileInput()
                ->widget(BootstrapFileInput::class, [
                        'options' => ['accept' => 'image/*'],
                        'clientOptions'=>[
                            'allowedFileExtensions'=>['jpg','gif','png'],
                            'showUpload' => false,
                            'dropZoneEnabled' => false,
                            'initialPreview'=> $model->isNewRecord ? false :
                                [
                                    Html::img("@widgetGalleryPicsWeb/{$model->id}/middle/{$model->img}", ['style'=>'width: 100%; height: auto;', 'alt'=>'нет изображения']),//картинка ,которая уже загружена у обновляемой записи
                                ],
                            'maxFileSize'=>4000,
                            'minImageWidth'=> 600,
                            'minImageHeight'=> 300,
                        ],
                ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
