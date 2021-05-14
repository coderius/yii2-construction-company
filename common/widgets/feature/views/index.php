<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

$css = <<< CSS
.feature{
    margin-bottom:0 !important;
}
CSS;

$this->registerCss($css);

?>

<?php if($model): ?>
<!-- Feature Start-->
<div class="feature wow fadeInUp" data-wow-delay="0.1s">
    <div class="container-fluid">
        <div class="row align-items-center">
            <?php foreach($model as $item): ?>
            <div class="col-lg-4 col-md-12">
                <div class="feature-item">
                    <div class="feature-icon">
                    <?= $item->icon; ?>
                    </div>
                    <div class="feature-text">
                        <h3><?= $item->header; ?></h3>
                        <p><?= $item->text; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- <div class="col-lg-4 col-md-12">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="flaticon-building"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Quality Work</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phasus nec pretim ornare velit non</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="flaticon-call"></i>
                    </div>
                    <div class="feature-text">
                        <h3>24/7 Support</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phasus nec pretim ornare velit non</p>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- Feature End-->
<?php endif; ?>