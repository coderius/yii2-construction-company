<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use yii\helpers\ArrayHelper;
use backend\models\MenuTop;

Bootstrap4GlyphiconsAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuTopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menu Tops');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-top-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Menu Top'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'font-size: 100%; color: #d2d2d2;']
            ],

            'id',
            'alias',
            'name',
            // 'parentId',
            [
                'attribute' => 'parentId',
                'format' => 'raw',
                'filter' => ArrayHelper::map(backend\models\MenuTop::find()->all(), 'id', 'name'),
                'value' => function ($model, $key, $index, $column) {
                    $item = $model->getParentItem();
                    return $item ? $item->name : $item;
                },
            ],

            'sortOrder',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    MenuTop::DISABLED_STATUS => MenuTop::$statusesName[MenuTop::DISABLED_STATUS],
                    MenuTop::ACTIVE_STATUS =>  MenuTop::$statusesName[MenuTop::ACTIVE_STATUS],
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === MenuTop::ACTIVE_STATUS;
                    return Html::tag('span',
                        $active ? 
                            MenuTop::$statusesName[MenuTop::ACTIVE_STATUS] 
                            : 
                            MenuTop::$statusesName[MenuTop::DISABLED_STATUS],
                        [
                            'class' => 'badge badge-' . ($active ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
            [
                'contentOptions' => ['title' => 'Дата создания', 'style' => 'font-size: 12px'],
                'attribute' => 'createdAt',
                'format' => ['datetime', 'php:d F (D.) Yг. в Hч.iм.'],
            ],

            [
                'contentOptions' => ['title' => 'Дата создания', 'style' => 'font-size: 12px'],
                'attribute' => 'updatedAt',
                'format' => ['datetime', 'php:d F (D.) Yг. в Hч.iм.'],
            ],
            [
                'attribute' => 'createdBy',
                'format' => 'raw',
                'filter' => ArrayHelper::map(common\models\user\User::find()->all(), 'id', 'username'),
                'value' => 'createdBy0.username',
            ],

            // 'updatedBy',
            [
                'attribute' => 'updatedBy',
                'format' => 'raw',
                'filter' => ArrayHelper::map(common\models\user\User::find()->all(), 'id', 'username'),
                'value' => 'updatedBy0.username',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
