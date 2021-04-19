<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Price */

$this->title = Yii::t('app', 'Create Price');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //Pjax::begin(['id' => 'form-create']) ?>
    <?= $this->render('_form', [
        'model' => $model,
        'formAction' => 'pjax-create',
        'formIdSelector' => 'form'
    ]) ?>
    <?php //Pjax::end(); ?>
</div>
