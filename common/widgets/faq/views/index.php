<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<!-- FAQs Start -->
<div class="faqs">
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

        <?php

        $count = count($model);
        $firstItemCount = ceil($count/2);
        $i = 1;
        ?>

            <!-- accordion-1 -->
            <div class="col-md-6">
                <div id="accordion-1">
                <?php foreach($model as $k => $m): ?>
                    <?php if($k < $firstItemCount): ?>
                    <div class="card wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#collapse<?= $k; ?>">
                            <?= $m->header; ?>
                            </a>
                        </div>
                        <div id="collapse<?= $k; ?>" class="collapse" data-parent="#accordion-1">
                            <div class="card-body">
                            <?= $m->text; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            </div>

            <!-- accordion-2 -->
            <div class="col-md-6">
                <div id="accordion-2">
                <?php foreach($model as $k => $m): ?>
                    <?php if($k >= $firstItemCount): ?>
                    <div class="card wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#collapse<?= $k; ?>">
                            <?= $m->header; ?>
                            </a>
                        </div>
                        <div id="collapse<?= $k; ?>" class="collapse" data-parent="#accordion-1">
                            <div class="card-body">
                            <?= $m->text; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            </div>

        </div>
        <?php endif; ?>
    </div>
</div>
<!-- FAQs End -->