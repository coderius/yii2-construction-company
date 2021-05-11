<?php

use common\widgets\carousel\CarouselWidget;
use common\widgets\feature\FeatureWidget;
use common\widgets\fact\FactWidget;
use common\widgets\gallery\GalleryWidget;
use common\widgets\video\VideoWidget;
use common\widgets\socialGallery\SocialGalleryWidget;
use common\widgets\faq\FaqWidget;
use common\widgets\testimonial\TestimonialWidget;
use common\widgets\blogList\BlogListWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

?>

<!-- Page Start -->
<div class="about wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="about-img">
                    <img src='<?= Yii::getAlias("@pageHeaderPicsWeb/{$model->id}/middle/{$model->storyImg}"); ?>' alt="Image">
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="section-header text-left">
                    <p><?= $model->storyHeader1; ?></p>
                    <h2><?= $model->storyHeader2; ?></h2>
                </div>
                <div class="about-text">
                    <?= $model->storyText; ?>
                    <p><a class="btn" href="<?= Url::toRoute($model->storyButtonAlias); ?>"><?= $model->storyButtonTitle; ?></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page End -->