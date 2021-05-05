<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use backend\models\Widgets;
use yii\helpers\ArrayHelper;
use backend\models\Page;

/* @var $this yii\web\View */
/* @var $model backend\models\PageWidgets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-widgets-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pageId')
            ->dropDownList(
                ArrayHelper::map(Page::find()->all(), 'id', 'storyHeader1'),
                    [
                        'prompt'=>'Выбрать страницу'
                    ]);
    ?>

    <?= $form->field($model, 'template')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
