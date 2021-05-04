<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<!-- Testimonial Start -->
<div class="testimonial wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="testimonial-slider-nav">
                <?php foreach($model as $m): ?>
                <div class="slider-nav"><?= Html::img("@widgetTestimonialPicsWeb/{$m->id}/small/{$m->img}", ["alt" => "Testimonial"]); ?></div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="testimonial-slider">
                <?php foreach($model as $m2): ?>
                    <div class="slider-item">
                        <h3><?= $m2->header1; ?></h3>
                        <h4><?= $m2->header2; ?></h4>
                        <p><?= $m2->text; ?></p>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->