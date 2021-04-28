<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetBloglist */

$this->title = Yii::t('app', 'Create Widget Bloglist');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Widget Bloglists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-bloglist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
