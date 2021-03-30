<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\CommonAsset;
use frontend\assets\AppThemeOrangeAsset;
use frontend\assets\GoogleFontsAsset;
use frontend\assets\FontAwesomeAsset;
use frontend\assets\FlaticonAsset;
use frontend\assets\AnimateAsset;
use frontend\assets\OwlcarouselAsset;
use frontend\assets\LightboxAsset;
use frontend\assets\SlickAsset;
use frontend\assets\EasingAsset;
use frontend\assets\WowAsset;
use frontend\assets\IsotopeAsset;
use frontend\assets\WaypointsAsset;
use frontend\assets\CounterupAsset;

GoogleFontsAsset::register($this);
CommonAsset::register($this);
FontAwesomeAsset::register($this);
FlaticonAsset::register($this);
AnimateAsset::register($this);
OwlcarouselAsset::register($this);
LightboxAsset::register($this);
SlickAsset::register($this);


// Only JS libs
EasingAsset::register($this);
WowAsset::register($this);
IsotopeAsset::register($this);
WaypointsAsset::register($this);
CounterupAsset::register($this);

AppThemeOrangeAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper"><!--Wrapper Start -->
<?= $this->render('partials/_top-bar', []); ?>
<?= $this->render('partials/_nav-bar', []); ?>

<?= $content ?>

<?= $this->render('partials/_footer', []); ?>
<?= $this->render('partials/_back-to-top', []); ?>

<?= $this->render('partials/_end-body', []); ?>
</div><!--Wrapper End -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
