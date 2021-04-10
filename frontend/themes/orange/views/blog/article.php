<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */

$js = <<< JS
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
JS;

$this->registerJs($js);

?>



<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?= $article->header1 ? $article->header1 : $article->metaTitle; ?></h2>
            </div>
            <div class="col-12">
                <a href="<?= Url::home(); ?>">Главная</a>
                <span data-toggle="tooltip" data-placement="bottom" title="Вы тут ..."><?= $article->metaTitle; ?></span>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Single Post Start-->
<div class="single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-content wow fadeInUp">
                    <?= Html::img("@blogPostHeaderPicsWeb/$article->id/middle/$article->img"); ?>
                    <div class="single-content-text">
                    <?= $article->text; ?>
                    </div>
                    
                </div>

                <?php if($tags): ?>
                <!-- Tags -->
                <div class="single-tags wow fadeInUp">
                    <?php foreach($tags as $tag): ?>
                    <?= Html::a($tag->header, ['blog/tag', 'alias' => $tag->alias], []); ?>
                    <?php endforeach; ?>
                </div>
                <!-- Tags -->
                <?php endif; ?>

                <?php if($author): ?>
                <!-- Author -->
                <div class="single-bio wow fadeInUp">
                    <div class="single-bio-img">
                        <?= Html::img("@userProfilePicsWeb/{$author->id}/middle/{$author->userProfile->img}"); ?>
                    </div>
                    <div class="single-bio-text">
                        <h3><?= $author->username; ?></h3>
                        <?php if($author->userProfile->hasText()): ?>
                        <p>
                        <?= $author->userProfile->text; ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ./Author -->
                <?php endif; ?>

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
<!-- Comments -->

                <!-- <div class="single-comment wow fadeInUp">
                    <h2>3 Comments</h2>
                    <ul class="comment-list">
                        <li class="comment-item">
                            <div class="comment-body">
                                <div class="comment-img">
                                    <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/user.jpg" />
                                </div>
                                <div class="comment-text">
                                    <h3><a href="">Josh Dunn</a></h3>
                                    <span>01 Jan 2045 at 12:00pm</span>
                                    <p>
                                        Lorem ipsum dolor sit amet elit. Integer lorem augue purus mollis sapien, non eros leo in nunc. Donec a nulla vel turpis tempor ac vel justo. In hac platea dictumst. 
                                    </p>
                                    <a class="btn" href="">Reply</a>
                                </div>
                            </div>
                        </li>
                        <li class="comment-item">
                            <div class="comment-body">
                                <div class="comment-img">
                                    <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/user.jpg" />
                                </div>
                                <div class="comment-text">
                                    <h3><a href="">Josh Dunn</a></h3>
                                    <p><span>01 Jan 2045 at 12:00pm</span></p>
                                    <p>
                                        Lorem ipsum dolor sit amet elit. Integer lorem augue purus mollis sapien, non eros leo in nunc. Donec a nulla vel turpis tempor ac vel justo. In hac platea dictumst. 
                                    </p>
                                    <a class="btn" href="">Reply</a>
                                </div>
                            </div>
                            <ul class="comment-child">
                                <li class="comment-item">
                                    <div class="comment-body">
                                        <div class="comment-img">
                                            <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/user.jpg" />
                                        </div>
                                        <div class="comment-text">
                                            <h3><a href="">Josh Dunn</a></h3>
                                            <p><span>01 Jan 2045 at 12:00pm</span></p>
                                            <p>
                                                Lorem ipsum dolor sit amet elit. Integer lorem augue purus mollis sapien, non eros leo in nunc. Donec a nulla vel turpis tempor ac vel justo. In hac platea dictumst. 
                                            </p>
                                            <a class="btn" href="">Reply</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="comment-form wow fadeInUp">
                    <h2>Leave a comment</h2>
                    <form>
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" class="form-control" id="website">
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Post Comment" class="btn">
                        </div>
                    </form>
                </div> -->
<!-- ./Comments -->
            </div>
            <?= $this->render('//layouts/partials/_sidebar', compact('sidebar')); ?>


        </div>
    </div>
</div>
<!-- Single Post End-->   