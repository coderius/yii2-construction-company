<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Widgets;
use dosamigos\fileinput\BootstrapFileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetTestimonial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-testimonial-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widgetId')
            ->dropDownList(
                ArrayHelper::map(Widgets::find()->where(['type' => Widgets::TYPE_TESTIMONIAL])->all(), 'id', 'descriptions'),
                    [
                        'prompt'=>'Выбрать категорию'
                    ]);
    ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?php echo $form->field($model, 'file')
                ->fileInput()
                ->widget(BootstrapFileInput::class, [
                        'options' => ['accept' => 'image/*'],
                        'clientOptions'=>[
                            'allowedFileExtensions'=>['jpg','gif','png'],
                            'showUpload' => false,
                            'dropZoneEnabled' => false,
                            'initialPreview'=> $model->isNewRecord ? false :
                            (is_file(Yii::getAlias("@widgetTestimonialPicsWeb/{$model->id}/small/{$model->img}")) ?
                                [Html::img("@widgetTestimonialPicsWeb/{$model->id}/small/{$model->img}", ['style'=>'width: 100%; height: auto;', 'alt'=>'нет изображения'])]
                                :
                                false),
                            
                            'maxFileSize'=>4000,
                            'minImageWidth'=> 600,
                            'minImageHeight'=> 300,
                        ],
                ]);
    ?>

    <?= $form->field($model, 'header1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
