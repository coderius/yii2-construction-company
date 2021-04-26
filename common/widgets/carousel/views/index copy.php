<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

// $entities

$countAll = $model->countWidgetCarousels();
?>

<?php if($model->hasWidgetCarousels()): ?>

<!-- Carousel Start -->
<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for($i = 0; $i < $countAll; $i++): ?>
        <li data-target="#carousel" data-slide-to="<?= $i; ?>" class="<?= $i === 0 ? 'active' : ''; ?>"></li>
        <?php endfor; ?>
    </ol>
    <div class="carousel-inner">
        <?php $counter = 1; ?>
        <?php foreach($model->widgetCarousels as $item): ?>
        <div class="carousel-item <?= $counter === 1 ? 'active' : ''; ?>">
            <?= Html::img("@widgetCarouselPicsWeb/{$item->id}/big/{$item->img}", ['alt'=> $item->header1]); ?>
            <div class="carousel-caption">
                <p class="animated fadeInRight"><?= $item->header1; ?></p>
                <h1 class="animated fadeInLeft"><?= $item->header2; ?></h1>
                <a class="btn animated fadeInUp" href="<?= $item->buttonLink; ?>"><?= $item->buttonTitle; ?></a>
            </div>
        </div>
        <?php $counter++; ?>
        <?php endforeach; ?>

    </div>

    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Carousel End -->

<?php endif; ?>