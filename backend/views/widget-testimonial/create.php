<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetTestimonial */

$this->title = Yii::t('app', 'Create Widget Testimonial');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Widget Testimonials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-testimonial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
