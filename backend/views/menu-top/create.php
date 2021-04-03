<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuTop */

$this->title = Yii::t('app', 'Create Menu Top');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu Tops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-top-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
