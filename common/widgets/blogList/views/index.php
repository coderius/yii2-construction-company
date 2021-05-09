<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use common\components\helpers\TextHelper;

?>
<!-- Blog Start -->
<div class="blog">
    <div class="container">
        <div class="section-header text-center">
        <!-- Header -->
        <?php if(isset($params['header'])): ?>
            <p><?= $params['header']; ?></p>
        <?php endif; ?>

        <?php if(isset($params['descriptions'])): ?>
            <h2><?= $params['descriptions']; ?></h2>
        <?php endif; ?>
        <!-- ./Header -->
        </div>
        <div class="row">
        <?php foreach($model as $item): ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="blog-item">
                    <div class="blog-img">
                    <?= Html::img("@blogPostHeaderPicsWeb/{$item->id}/middle/{$item->img}"); ?>
                    </div>
                    <div class="blog-title">
                        <h3><?= TextHelper::truncate($item->header1, 150); ?></h3>
                        <?= Html::a("<span>+</span>", ['blog/article', 'alias' => $item->alias], ['class' => "btn"]); ?>
                    </div>
                    <div class="blog-meta">
                        <p>By<?= Html::a($item->createdBy0->username, ['#']); ?></p>
                        <p>In<?= Html::a($item->category->header, ['blog/category', 'alias' => $item->category->alias]); ?></p>
                    </div>
                    <div class="blog-text equal-height">
                        <p>
                        <?= TextHelper::truncate($item->header1, 150); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
            
        </div>
    </div>
</div>
<!-- Blog End -->