<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$js = <<< JS
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
JS;
$this->registerJs($js);

?>
index