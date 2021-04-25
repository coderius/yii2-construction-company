<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\WidgetCarousel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Widget Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="widget-carousel-view m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'widgetId',
            [
                'label' => 'widget description',
                'format' => 'raw',
                'value'  => call_user_func(
                            function ($model){ 
                                return $model->widget->descriptions;
                    
                            }, $model
                        
                        ),
            ],
            'header1',
            'header2',
            'buttonTitle',
            'buttonLink',
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value'  => Html::img("@widgetCarouselPicsWeb/{$model->id}/big/{$model->img}", ['alt'=> $model->imgAlt,'title'=> $model->imgAlt, 'style'=>'width: 50%; height: auto;']),
            ],
            'imgAlt',
        ],
    ]) ?>

</div>
