<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\widgets\IosStyleToggleSwitch\IosStyleToggleSwitchWidget;
use dosamigos\tinymce\TinyMce;
use yii\web\JsExpression;
use yii\helpers\Url;
use dosamigos\fileinput\BootstrapFileInput;

//Add to BootstrapFileInput error item
$js = <<< JS
el = $(document).find('.field-portfolio-file').find('.invalid-feedback');
el.css("display", "block");
console.log(el);
JS;
$this->registerJs($js, \yii\web\View::POS_END);

// var_dump($model->getErrors());
?>

<div class="portfolio-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'selectedCategories')
            ->dropDownList(
                    $mapCategories,
                    [
                        // 'prompt'=>'Выбрать категорию'
                    ]); ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'file')
                ->fileInput()
                ->widget(BootstrapFileInput::classname(), [
                        'options' => ['accept' => 'image/*'],
                        'clientOptions'=>[
                            'allowedFileExtensions'=>['jpg','gif','png'],
                            'showUpload' => false,
                            'dropZoneEnabled' => false,
                            'initialPreview'=> $model->isNewRecord ? false :
                                [
                                    Html::img("@portfolioPicsWeb/{$model->id}/middle/{$model->img}", ['style'=>'width: 100%; height: auto;', 'alt'=>'нет изображения', 'title'=>$model->imgAlt]),//картинка ,которая уже загружена у обновляемой записи
                                ],
                            'maxFileSize'=>4000,
                            'minImageWidth'=> 600,
                            'minImageHeight'=> 300,
                        ],
                                                ]);


    ?>

    <?= $form->field($model, 'imgAlt')->textInput(['maxlength' => true]) ?>

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
