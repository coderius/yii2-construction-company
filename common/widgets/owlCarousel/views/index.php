<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<div class="single-related wow fadeInUp">
    <?php if($entity->hasTitle()): ?>
    <h2><?= $entity->getTitle(); ?></h2>
    <?php endif; ?>
    <?php if($entity->hasItems()): ?>
    <div class="owl-carousel related-slider">
        <?php foreach($entity->getItems() as $item): ?>
        <div class="post-item">
            <?php if($item->hasImage()): ?>
            <!-- image -->
            <div class="post-img">
                <?php if($item->getImage()->hasSrc()): ?>
                <img src="<?= $item->getImage(); ?>" />
                <?php endif; ?>
            </div>
            <!-- ./image -->
            <?php endif; ?>

            <div class="post-text">
                <?php if($item->hasHeader()): ?>
                <!-- post-text -->
                <a href="<?= $item->getHeader()->getUrl(); ?>">
                    <?= $item->getHeader()->getText(); ?>
                </a>
                <!-- ./post-text -->
                <?php endif; ?>

                <?php if($item->hasMeta() && $item->isItemsMeta()): ?>
                <!-- post-meta -->
                <div class="post-meta">
                    <?php if($item->getMeta()): ?>
                        <p>By<a href="<?= $item->getMetaByKey(0)->getUrl(); ?>"><?= $item->getMetaByKey(0)->getText(); ?></a></p>
                        <p>In<a href="<?= $item->getMetaByKey(1)->getUrl(); ?>"><?= $item->getMetaByKey(1)->getText(); ?></a></p>
                    <?php endif; ?>
                
                </div>
                <!-- ./post-meta -->
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>