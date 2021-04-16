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
// var_dump($model->getPortfolio()->count());die;
?>
<div class="col-lg-4 col-md-6 wow fadeInUp" <?= $show ? "data-wow-delay='0.2s'" : ''; ?>  >
    <div class="blog-item">
        <div class="blog-item-header">
        <?= Html::a("", ['portfolios/category/'.$model->alias], ['class' => "link-cover"]); ?>
            <div class="blog-img">
            <?php if($model->hasFront()): ?>
                <?= Html::img("@portfolioPicsWeb/{$model->front->id}/middle/{$model->front->img}"); ?>
            <?php else: ?>
                <?= Html::img("@portfolioCategoryPicDefaultWeb"); ?>
            <?php endif; ?>
            </div>
            <div class="blog-title">
                <h3><?= TextHelper::truncate($model->metaDesc, 150); ?></h3>
                <?= Html::a("<span>+</span>", ['blog/article', 'alias' => $model->alias], ['class' => "btn"]); ?>
            </div>
            
        </div>
        <div class="blog-meta">
            <p>By<?= Html::a($model->createdBy0->username, ['#']); ?></p>
            <p>Кол-во фото: <?= $model->getPortfolio()->active()->count(); ?></p>
        </div>
        <div class="blog-text equal-height">
            <p>
            <?= TextHelper::truncate($model->metaDesc, 150); ?>
            </p>
        </div>
    </div>
</div>