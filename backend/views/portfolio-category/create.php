<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PortfolioCategory */

$this->title = Yii::t('app', 'Create Portfolio Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Portfolio Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mapTags' => $mapTags
    ]) ?>

</div>
