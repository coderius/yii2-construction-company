<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <div class="container">
        <div class="section-header text-center">
            <h2><?= Html::encode($this->title); ?></h2>
            <p>Please fill out the following fields to signup:</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => false]); ?>

            <?= $form->field($model, 'email'); ?>

            <?= $form->field($model, 'password')->passwordInput(); ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']); ?>
            </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
