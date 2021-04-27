<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetFact */

$this->title = Yii::t('app', 'Create Widget Fact');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Widget Facts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-fact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
