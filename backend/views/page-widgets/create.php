<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PageWidgets */

$this->title = Yii::t('app', 'Create Page Widgets');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Page Widgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-widgets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
