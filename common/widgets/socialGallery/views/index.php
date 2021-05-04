<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<!-- Team Start -->
<div class="team">
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
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item">
                    <div class="team-img">
                    <?= Html::img("@widgetSocialGalleryPicsWeb/{$m->id}/middle/{$m->img}", ['alt' => $m->header1]); ?>
                    </div>
                    <div class="team-text">
                        <h2><?= $m->header1; ?></h2>
                        <p><?= $m->header2; ?></p>
                    </div>
                    <div class="team-social">

                        <?php if($m->twitter): ?>
                        <a class="social-tw" href="<?= $m->twitter; ?>"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>

                        <?php if($m->facebook): ?>
                        <a class="social-fb" href="<?= $m->twitter; ?>"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>

                        <?php if($m->linkedin): ?>
                        <a class="social-li" href="<?= $m->linkedin; ?>"><i class="fab fa-linkedin-in"></i></a>
                        <?php endif; ?>

                        <?php if($m->instagram): ?>
                        <a class="social-in" href="<?= $m->instagram; ?>"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
       </div>
        <?php endif; ?>
    </div>
</div>
<!-- Team End -->