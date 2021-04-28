<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetSocialgallery */

$this->title = Yii::t('app', 'Create Widget Socialgallery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Widget Socialgalleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-socialgallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
