<?php

/* @var $this yii\web\View */

use common\components\helpers\TextHelper;
use yii\helpers\Html;

//echo \Yii::$app->request->userIP;die;
//phpinfo();
//gmdate("Y-m-d H:i:s")
//Yii::$app->timeZone = 'Europe/Kiev';
// var_dump($model);
?>

<div class="col-lg-12 search-item">
    <?= Html::a(TextHelper::truncate($model->header1, 150),
        ['blog/article', 'alias' => $model->alias],
        ['class' => 'search-title']);
    ?>
    <div>
        <?= TextHelper::truncate($model->text, 250); ?>
    </div>
</div>
