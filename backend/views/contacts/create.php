<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Contacts */

$this->title = Yii::t('app', 'Create Contacts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
