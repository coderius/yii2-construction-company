<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use common\components\helpers\TextHelper;

//echo \Yii::$app->request->userIP;die;
//phpinfo();
//gmdate("Y-m-d H:i:s")
//Yii::$app->timeZone = 'Europe/Kiev';
// var_dump($model);
?>

<div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first wow fadeInUp" <?= $show ? "data-wow-delay='0.2s'" : ''; ?>>
    <div class="portfolio-warp">
    <?= Html::a("", ['portfolios/category/'.$model->alias], ['class' => "link-cover"]); ?>
        <div class="portfolio-img">
            <?php if($model->hasFront()): ?>
                <?= Html::img("@portfolioPicsWeb/{$model->front->id}/middle/{$model->front->img}"); ?>
            <?php else: ?>
                <?= Html::img("@portfolioCategoryPicDefaultWeb"); ?>
            <?php endif; ?>
            <div class="portfolio-overlay">
                <p>
                <?= TextHelper::truncate($model->metaDesc, 150); ?>
                </p>
            </div>
        </div>
        <div class="portfolio-text">
            <h3><?= TextHelper::truncate($model->headerShort, 150); ?></h3>
            <a class="btn" href="img/portfolio-1.jpg" data-lightbox="portfolio">+</a>
        </div>
    </div>
</div>