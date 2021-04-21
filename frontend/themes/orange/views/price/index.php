<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

// var_dump($price);
?>

<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?= $heading; ?></h2>
            </div>
            <div class="col-12">
                <a href="<?= Url::home(); ?>">Главная</a>
                <span data-toggle="tooltip" data-placement="bottom" title="Вы тут ..."><?= $crumbName; ?></span>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Blog Start -->
<div class="blog">
    <div class="container">
        <div class="section-header text-center">
            <p><?= $heading2; ?></p>
            <h2><?= $heading3; ?></h2>
        </div>

        <div class="row blog-page">
        <div class="col-lg-12 wow fadeInUp"  data-wow-delay="0.2s">
            <!-- Прайс -->
            <?= $this->render("_content", compact("price")); ?>
            <!-- Прайс -->
        </div>
        
        </div>
    </div>
</div>
<!-- Blog End -->