<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BlogArticle */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blog Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blog-article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'alias',
            [
                'label' => 'Категория',
                'format' => 'raw',
                'value'  => call_user_func(
                            function ($model){ 
                                $res = [];
                                foreach($model->getCategories()->all() as $category ){
                                    $url = \Yii::$app->urlManagerFrontend->createUrl(["blog/category/{$category->alias}"]);
                                    $res[] = Html::a($category->metaTitle, $url, ["class"=>"label label-default", 'target' => '_blank']);
                                }
                                return !empty($res) ? implode(' ', $res) : null;
                                
                            }, $model
                        
                        ),
                
                
            ],
            [
                'label' => 'Теги',
                'format' => 'raw',
                'value'  => call_user_func(
                            function ($model){ 
                    
                                $res = [];
                                foreach($model->getTags()->all() as $tag ){
                                    $url = \Yii::$app->urlManagerFrontend->createUrl(["blog/tag/{$tag->alias}"]);
                                    $res[] = Html::a($tag->metaTitle, $url, ["class"=>"label label-default", 'target' => '_blank']);
                                }
                                return !empty($res) ? implode(' ', $res) : null;
                    
                            }, $model
                        
                        ),
            ],
            'metaTitle',
            'metaDesc',
            'status',
            'header1',
            'text:ntext',
            'img:ntext',
            'viewCount',
            'createdAt',
            'updatedAt',
            'createdBy',
            'updatedBy',
        ],
    ]) ?>

</div>
