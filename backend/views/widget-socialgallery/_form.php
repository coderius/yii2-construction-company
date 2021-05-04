<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use dosamigos\fileinput\BootstrapFileInput;
use backend\models\Widgets;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetSocialgallery */
/* @var $form yii\widgets\ActiveForm */

$js = <<< JS
el = $(document).find('.field-widgetsocialgallery-file').find('.invalid-feedback');
el.css("display", "block");
// console.log(el);
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>

<div class="widget-socialgallery-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widgetId')
            ->dropDownList(
                ArrayHelper::map(Widgets::find()->where(['type' => Widgets::TYPE_SOCIALGALLERY])->all(), 'id', 'descriptions'),
                    [
                        'prompt'=>'Выбрать категорию'
                    ]); ?>

    <?= $form->field($model, 'sortOrder')->textInput() ?>

    <?php echo $form->field($model, 'file')
                ->fileInput()
                ->widget(BootstrapFileInput::classname(), [
                        'options' => ['accept' => 'image/*'],
                        'clientOptions'=>[
                            'allowedFileExtensions'=>['jpg','gif','png'],
                            'showUpload' => false,
                            'dropZoneEnabled' => false,
                            'initialPreview'=> $model->isNewRecord ? false :
                            (is_file(Yii::getAlias("@widgetGalleryPicsWeb/{$model->id}/middle/{$model->img}")) ?
                                [Html::img("@widgetGalleryPicsWeb/{$model->id}/middle/{$model->img}", ['style'=>'width: 100%; height: auto;', 'alt'=>'нет изображения'])]
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

    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
