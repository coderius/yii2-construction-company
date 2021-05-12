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

//Register counter when click in image
$urlSendEmail = Url::to(['portfolios/pic-update-counter']);

$js = <<< JS
var linkCover = $(".link-cover");

linkCover.on('click', function(e){
    var id = $(this).data("id");
    console.log("click", id);
    $.ajax({
            type: 'post',
            url: '$urlSendEmail',
            data: {id:id},
        })
        .done(function(data){
            if(data.success) {
                console.log(data);
            } else {
                console.log(data);
            }
        });
});

JS;

$this->registerJs($js);

?>
<!-- Photos in this category -->
<div class="col-lg-4 col-md-6 col-sm-12 portfolio-item wow fadeInUp" <?= $show ? "data-wow-delay='0.2s'" : ''; ?>>
    <div class="portfolio-warp">

        <?php if($model->img): ?>
            <a class="link-cover" data-id="<?= $model->id; ?>" href="<?= Yii::getAlias("@portfolioPicsWeb/{$model->id}/big/{$model->img}"); ?>" data-lightbox="portfolio"></a>
        <?php else: ?>
            <a class="" href="#" data-lightbox="portfolio"></a>
        <?php endif; ?>

        <div class="portfolio-img">
            <?php if($model->img): ?>
                <?= Html::img("@portfolioPicsWeb/{$model->id}/middle/{$model->img}"); ?>
            <?php else: ?>
                <?= Html::img("@portfolioCategoryPicDefaultWeb"); ?>
            <?php endif; ?>
            <div class="portfolio-overlay">
                <p>
                <?= TextHelper::truncate($model->description, 150); ?>
                </p>
            </div>
        </div>
        <div class="portfolio-text">
            <h3><?= TextHelper::truncate($model->header, 150); ?></h3>
            <a class="btn" href="#" data-lightbox="portfolio">+</a>
        </div>
    </div>
</div>