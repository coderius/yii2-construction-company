<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetFeature */

$this->title = Yii::t('app', 'Create Widget Feature');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Widget Features'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-feature-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
