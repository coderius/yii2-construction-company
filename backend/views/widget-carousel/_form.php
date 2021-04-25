<?php

use yii\helpers\Html;
use dosamigos\fileinput\BootstrapFileInput;
use yii\bootstrap4\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use backend\models\Widgets;


/* @var $this yii\web\View */
/* @var $model backend\models\WidgetCarousel */
/* @var $form yii\widgets\ActiveForm */

var_dump($model->getErrors());
?>

<div class="widget-carousel-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'selectedWidget')
            ->dropDownList(
                ArrayHelper::map(Widgets::find()->where(['type' => Widgets::TYPE])->all(), 'id', 'descriptions'),
                    [
                        'prompt'=>'Выбрать категорию'
                    ]); ?>

    <?= $form->field($model, 'header1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buttonTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buttonLink')->textInput(['maxlength' => true]) ?>

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
                                    Html::img("@widgetCarouselPicsWeb/{$model->id}/big/{$model->img}", ['style'=>'width: 50%; height: auto;', 'alt'=>'нет изображения', 'title'=>$model->imgAlt]),//картинка ,которая уже загружена у обновляемой записи
                                ],
                            'maxFileSize'=>4000,
                            'minImageWidth'=> 800,
                            'minImageHeight'=> 400,
                        ],
                                                ]);


    ?>

    <?= $form->field($model, 'imgAlt')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
