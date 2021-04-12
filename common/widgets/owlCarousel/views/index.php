<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<div class="single-related wow fadeInUp">
    <h2>Related Post</h2>
    <div class="owl-carousel related-slider">
        <div class="post-item">
            <div class="post-img">
                <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/post-1.jpg" />
            </div>
            <div class="post-text">
                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                <div class="post-meta">
                    <p>By<a href="">Admin</a></p>
                    <p>In<a href="">Design</a></p>
                </div>
            </div>
        </div>
        <div class="post-item">
            <div class="post-img">
                <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/post-2.jpg" />
            </div>
            <div class="post-text">
                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                <div class="post-meta">
                    <p>By<a href="">Admin</a></p>
                    <p>In<a href="">Design</a></p>
                </div>
            </div>
        </div>
        <div class="post-item">
            <div class="post-img">
                <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/post-3.jpg" />
            </div>
            <div class="post-text">
                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                <div class="post-meta">
                    <p>By<a href="">Admin</a></p>
                    <p>In<a href="">Design</a></p>
                </div>
            </div>
        </div>
        <div class="post-item">
            <div class="post-img">
                <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/post-4.jpg" />
            </div>
            <div class="post-text">
                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                <div class="post-meta">
                    <p>By<a href="">Admin</a></p>
                    <p>In<a href="">Design</a></p>
                </div>
            </div>
        </div>
    </div>
</div>