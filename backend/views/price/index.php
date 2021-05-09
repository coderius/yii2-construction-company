<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use backend\models\BlogArticle;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\jui\JuiAsset;

JuiAsset::register($this);
Bootstrap4GlyphiconsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Prices');
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to(['update']);
$urlCreate = Url::to(['create']);
$urlSort = Url::to(['sort-list']);// add view chacked lists
$urlSortSave = Url::to(['sort-save']);

$js = <<< JS
//------
//Create
//------
$('#btn-create-modal').on('click', function(e){
    e.preventDefault();
    var myModal = $("#create-modal");
    var modalBody = myModal.find('.modal-body');
    var modalTitle = myModal.find('.modal-header');
    modalTitle.find('h1').html('Создать.');

    $.ajax("$urlCreate")
        .then(function(result){
            myModal.modal("show");
            modalBody.html(result);
            var form = $('.create-form');
            form.attr('action', "$urlCreate");
            // console.log('ok-1');
            return form;
        })
        .then(function(form){
            var btn = form.find('.btn');
            console.log('ok-2');
            btn.on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serializeArray()
                })
                .done(function(data){
                    if(data.success) {
                        formValidationClear(form, '.invalid-feedback');
                        location.reload();
                    } else if (data.validation) {
                        // console.log(data.validation);
                        validationMessages(form, data.validation)
                    } else {
                        // incorrect server response
                    }
                })
                .fail(function () {
                    // request failed
                });
                return false;

            });
        });

        function validationMessages(form, data){
            $.each(data, function( index, messages ){
                var name = "Price[" + index + "]";
                var input = form.find("[name='"+name+"']");
                var invalidFeedback = input.next('.invalid-feedback');
                invalidFeedback.css("display", "block");
                messages.map(function(item) {
                    invalidFeedback.append( "<p>"+ item +"</p>" );
                    console.log(item);
                });
                console.log(invalidFeedback);
            });
        }

        function formDataClear(form){
            var clear = function(){
                form.find("input[type=text], textarea").val("").each(function () {
                    $(this).val("");
                });
            };
            clear();
        }

        function formValidationClear(form, invalidFeedbackSelector){
            form.find(invalidFeedbackSelector).each(function () {
                $(this).empty();
            });
        }
});
//------
//Create
//------


//------
//Update
//------
$('.action-icon-update').on('click', function(e){
    e.preventDefault();
    var id = $(this).data("key");
    var actionUrl = "$url?id=" + id;
    // console.log(actionUrl);
    var myModal = $("#update-modal");
    var modalBody = myModal.find('.modal-body');
    var modalTitle = myModal.find('.modal-header');
    
    modalTitle.find('h1').html('Обновить.');
    
    // modalBody.load(Url::to(['update', 'id' => 36]));

    $.ajax(actionUrl)
        .then(function(result){
            myModal.modal("show");
            modalBody.html(result);
            var form = $('.update-form');
            form.attr('action', actionUrl);
            // console.log('ok-1');
            return form;
        })
        .then(function(form){
            var btn = form.find('.btn');
            console.log('ok-2');
            btn.on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serializeArray()
                })
                .done(function(data){
                    if(data.success) {
                        formValidationClear(form, '.invalid-feedback');
                        location.reload();
                    } else if (data.validation) {
                        // console.log(data.validation);
                        validationMessages(form, data.validation)
                    } else {
                        // incorrect server response
                    }
                })
                .fail(function () {
                    // request failed
                });
                return false;

            });
        });

        function validationMessages(form, data){
            $.each(data, function( index, messages ){
                var name = "Price[" + index + "]";
                var input = form.find("[name='"+name+"']");
                var invalidFeedback = input.next('.invalid-feedback');
                invalidFeedback.css("display", "block");
                messages.map(function(item) {
                    invalidFeedback.append( "<p>"+ item +"</p>" );
                    console.log(item);
                });
                console.log(invalidFeedback);
            });
        }

        function formDataClear(form){
            var clear = function(){
                form.find("input[type=text], textarea").val("").each(function () {
                    $(this).val("");
                });
            };
            clear();
        }

        function formValidationClear(form, invalidFeedbackSelector){
            form.find(invalidFeedbackSelector).each(function () {
                $(this).empty();
            });
        }
});
//--------
//./Update
//--------


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

<div class="price-index m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Price'), ['create'], ['id' => 'btn-create-modal', 'class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'category',
                'format' => 'raw',
                'value' => function ($model) {
                        return "<a target='_blank' href=".\Yii::$app->urlManagerFrontend->createUrl(["/category/{$model->category->alias}"]).">" . $model->category->header . "</a>";
                },
            ],
            'categoryId',
            'name',
            'cost',
            'unit',
            'equal',
            'sortOrder',
            'status',
            //'createdAt',
            //'updatedAt',
            //'createdBy',
            //'updatedBy',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $iconName = "pencil";
            
                        $title = \Yii::t('yii', 'Update');
                        
                        $id = 'update-'.$key;
                        $options = [
                            'title' => $title,
                            'class' => 'action-icon-update',
                            'aria-label' => $title,
                            'data-pjax' => '0',
                            'id' => $id,
                            'data-key' => $key
                        ];
                        
                        $url = Url::current(['', 'id' => $key]);
                        
                        //Для стилизации используем библиотеку иконок
                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName"]);

                        return Html::a($icon, $url, $options);
                    }
                ],
            ],
        ],
    ]); ?>


</div>

<?php
Modal::begin([
    'title' => 'Create',
    // 'toggleButton' => ['label' => 'click me'],
    'options' => [
        'id' => 'create-modal',
    ],
]);

// echo $this->render('create',[
//     'model' => $model,
// ]);

Modal::end();

?>

<?php
Modal::begin([
    'title' => 'Update',
    // 'toggleButton' => ['label' => 'click me'],
    'options' => [
        'id' => 'update-modal',
    ],
]);

echo 'Content';

Modal::end();

?>

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
