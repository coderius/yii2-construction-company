<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use yii\helpers\ArrayHelper;
use backend\models\PriceCategory;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

Bootstrap4GlyphiconsAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PriceCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$urlSort = Url::to(['sort-list']);
$urlSortSave = Url::to(['sort-save']);

$js = <<< JS
//--------
//Sort
//--------

//Show alert window
$('#btn-sort-modal').on('click', function(e){
    e.preventDefault();
    var myModal = $("#sort-modal"),
        modalBody = myModal.find('.modal-body'),
        modalTitle = myModal.find('.modal-header');

    modalTitle.find('.modal-title').html('Сортировать.');
    myModal.modal("show");

    //Chacked ids
    var checked = $('.checkbox-class:checked');
    var selecteditems = [];
    if(checked.length > 0){
        checked.each(function (i, item) {
            selecteditems.push($(item).val());
        });
    }
    // console.log(selecteditems);
    //Make view ul list
    $.ajax({
        type: "POST",
        url: "$urlSort",
        data: { ids: selecteditems }
    })
    .then(function(result){

        if(result.empty){
            modalBody.find('.ui-sortable').html(result.empty);
            $('#btn-save-sorting').hide();
        }else{
            modalBody.find('.ui-sortable').html(result);
            $('#btn-save-sorting').show();
            $('#btn-save-sorting').on('click', function(e){
                e.preventDefault();
                var s = $('.ui-sortable').sortable( "serialize");
                $.ajax({
                    type: "POST",
                    url: "$urlSortSave",
                    data: { items: s }
                })
                .done(function(data){
                    // console.log(data);
                    if(data.success) {
                        modalBody.find('.ui-sortable').html(data.success);
                        location.reload();
                    } else if (data.error) {
                        modalBody.find('.ui-sortable').html(data.error);
                    } else {
                        // incorrect server response
                    }
                })
                .fail(function () {
                    // request failed
                });

            });

        }

    });

    myModal.on('hidden.bs.modal', function (e) {
        modalBody.find('.ui-sortable').html('');
    })
});
//--------
//./Sort
//--------
JS;

$this->registerJs($js);

$this->title = Yii::t('app', 'Price Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-category-index m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Price Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div>
    Редактирование:  
    <?= Html::a(Yii::t('app', 'Sorting items'), ['sort'], ['id' => 'btn-sort-modal', 'class' => 'badge badge-pill badge-success']) ?>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn', 
                'cssClass' => 'checkbox-class'
            ],

            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'font-size: 100%; color: #d2d2d2;']
            ],

            'id',
            'alias',
            'header',
            'description:ntext',
            'icon',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    PriceCategory::DISABLED_STATUS => PriceCategory::$statusesName[PriceCategory::DISABLED_STATUS],
                    PriceCategory::ACTIVE_STATUS =>  PriceCategory::$statusesName[PriceCategory::ACTIVE_STATUS],
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === PriceCategory::ACTIVE_STATUS;
                    return Html::tag('span',
                        $active ? 
                            PriceCategory::$statusesName[PriceCategory::ACTIVE_STATUS] 
                            : 
                            PriceCategory::$statusesName[PriceCategory::DISABLED_STATUS],
                        [
                            'class' => 'badge badge-' . ($active ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
            'sortOrder',
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
<?php
Modal::begin([
    'title' => 'Sort',
    // 'toggleButton' => ['label' => 'click me'],
    'options' => [
        'id' => 'sort-modal',
    ],
]);

//content
echo \yii\jui\Sortable::widget([
    'items' => [
        // [
        //     'content' => 'Item1',
        //     'options' => ['id' => 'item-1',],
        // ],
        // [
        //     'content' => 'Item2',
        //     'options' => ['id' => 'item-2',],
        // ],
        // [
        //     'content' => 'Item3',
        //     'options' => ['id' => 'item-3',],
        // ],
    ],
    'options' => ['tag' => 'ul'],
    'itemOptions' => ['tag' => 'li'],
    'clientOptions' => ['cursor' => 'move'],
]);

echo "<p>";
echo Html::a(Yii::t('app', 'Сохранить'), [''], ['id' => 'btn-save-sorting', 'class' => 'btn btn-success']);
echo "</p>";

Modal::end();

?>