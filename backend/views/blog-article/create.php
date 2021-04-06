<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BlogArticle */

$this->title = Yii::t('app', 'Create Blog Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-article-create m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact(
            'model',
            'mapCategories',
            'mapTags'
            )) ?>

</div>
