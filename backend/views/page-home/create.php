<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PageHome */

$this->title = Yii::t('app', 'Create Page Home');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Page Homes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-home-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
