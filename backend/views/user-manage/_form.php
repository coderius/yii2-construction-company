<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\UserManage;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;

Bootstrap4GlyphiconsAsset::register($this);
/* @var $this yii\web\View */
/* @var $model backend\models\UserManage */
/* @var $form yii\widgets\ActiveForm */
?>
<!-- <i class="glyphicon glyphicon-pencil"></i> -->
<div class="user-manage-form m-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role')
            ->dropDownList(
                    UserManage::makeSelectRoles(),
                    [
                        'prompt'=>'Not set',
                        // 'multiple'=>'multiple','style' => 'height: 100px'
                    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')
            ->dropDownList(
                    UserManage::$statusesName,
                    ['prompt'=>'Not set']); ?>

    

    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
