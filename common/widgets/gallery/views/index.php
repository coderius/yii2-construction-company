<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header text-center">
            <?php if(isset($params['header'])): ?>
            <p><?= $params['header']; ?></p>
            <?php endif; ?>
            <?php if(isset($params['descriptions'])): ?>
            <h2><?= $params['descriptions']; ?></h2>
            <?php endif; ?>
        </div>
        <?php if($model): ?>
        <div class="row">
        <?php foreach($model as $m): ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item">
                    <div class="service-img">
                        <?= Html::img("@widgetGalleryPicsWeb/{$m->id}/middle/{$m->img}"); ?>
                        <div class="service-overlay">
                            <p>
                                <?= $m->text; ?>
                            </p>
                        </div>
                    </div>
                    <div class="service-text">
                        <h3><?= $m->header; ?></h3>
                        <a class="btn" href="<?= Yii::getAlias("@widgetGalleryPicsWeb/{$m->id}/middle/{$m->img}");?>" data-lightbox="service">+</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- Service End -->