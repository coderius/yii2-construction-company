<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Price */

$this->title = Yii::t('app', 'Create Price');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'formAction' => 'create',
        'formClass' => 'create-form'
    ]) ?>

</div>
