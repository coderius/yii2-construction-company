<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Portfolio */

$this->title = Yii::t('app', 'Update Portfolio: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Portfolios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="portfolio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mapCategories' => $mapCategories
    ]) ?>

</div>
