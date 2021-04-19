<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use backend\models\BlogArticle;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

Bootstrap4GlyphiconsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Prices');
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to( ['update']);

$js = <<< JS
$('#btn-create-modal').on('click', function(e){
    e.preventDefault();
});

$('.action-icon-update').on('click', function(e){
    e.preventDefault();
    var id = $(this).data("key");
    var actionUrl = "$url?id=" + id;
    console.log(actionUrl);
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
            console.log('ok-1');
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
                        console.log(data.validation);
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

JS;

$this->registerJs($js);


?>

<div class="price-index m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Price'), ['create'], ['id' => 'btn-create-modal', 'class' => 'btn btn-success','data-toggle'=> 'modal', 'data-target'=> '#create-modal',]) ?>
    </p>

    <div>
    С отмеченными: 
    <?= Html::a(Yii::t('app', 'Sorting items'), ['sort'], ['id' => 'btn-sort-modal', 'class' => 'badge badge-pill badge-success','data-toggle'=> 'modal', 'data-target'=> '#create-modal',]) ?>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn', 
            ],
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'font-size: 100%; color: #d2d2d2;']
            ],

            'id',
            'categoryId',
            'name',
            'cost',
            'unit',
            'equal',
            //'sortOrder',
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
    'title' => 'Hello world',
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
    'title' => 'Hello world',
    // 'toggleButton' => ['label' => 'click me'],
    'options' => [
        'id' => 'update-modal',
    ],
]);

echo 'Content';

Modal::end();

?>