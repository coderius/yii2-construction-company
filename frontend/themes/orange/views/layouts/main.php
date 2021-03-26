<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\CommonAsset;
use frontend\assets\AppThemeOrangeAsset;
use frontend\assets\GoogleFontsAsset;

GoogleFontsAsset::register($this);
CommonAsset::register($this);

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

<?php $this->endBody() ?>
<?= $this->render('partials/_end-body', []); ?>
</div><!--Wrapper End -->
</body>
</html>
<?php $this->endPage() ?>
