<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

Bootstrap4GlyphiconsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WidgetCarouselSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Widget Carousels');
$this->params['breadcrumbs'][] = $this->title;

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

?>
<div class="widget-carousel-index m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Widget Carousel'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div>
    Редактирование:  
    <?= Html::a(Yii::t('app', 'Sorting items'), ['sort'], ['id' => 'btn-sort-modal', 'class' => 'badge badge-pill badge-success']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=> function ($model, $key, $index, $grid){
            $class = $index % 2 ?'odd':'even';
            return [
                'key'=> $key,
                'index'=> $index,
                'class'=> $class
            ];
        },
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn', 
                'cssClass' => 'checkbox-class'
            ],

            ['class' => 'yii\grid\SerialColumn'],
            
            'id',
            'sortOrder',
            'header1',
            'header2',
            'buttonTitle',
            'buttonLink',
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value'  => function ($model) {
                    return Html::img("@widgetCarouselPicsWeb/{$model->id}/big/{$model->img}", ['alt'=> $model->imgAlt,'title'=> $model->imgAlt, 'style'=>'width: 40%; height: auto;']);
                }
                
                
            ],
            'imgAlt',

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