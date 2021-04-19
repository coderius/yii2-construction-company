<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\assets\Bootstrap4Glyphicons\Bootstrap4GlyphiconsAsset;
use backend\models\BlogArticle;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Modal;
use yii\widgets\Pjax;

Bootstrap4GlyphiconsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Prices');
$this->params['breadcrumbs'][] = $this->title;


$js = <<< JS
//Modal
// $('#btn-create-modal').on('click', function(e){
//     e.preventDefault();
// });

// //Form
// $('#form').on('submit', function(e){
//     e.preventDefault();
//     // $.wait(5000);
// });

// //Pjax
// $("#form-create").on("pjax:end", function() {
//     // $.wait(5000);
//     console.log('ok');
//     // window.onbeforeunload = function(){
//     //         return 'Are you sure you want to leave?';
//     //     };
//     // $.pjax.reload({container:"#grid-price"});
//     // $.wait(5000);
// });

// $(document).on('ready pjax:success', function() {

// $('#form-button').click(function(e){

//    e.preventDefault(); //for prevent default behavior of <a> tag.



// });

// });

// $("#form-create").on("pjax:error", function() {

//     console.log('error');

// });


JS;

$this->registerJs($js);

?>
<div class="price-index m-2">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Price'), ['create'], ['id' => 'btn-create-modal', 'class' => 'btn btn-success','data-toggle'=> 'modal', 'data-target'=> '#create-modal',]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id' => 'grid-price']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end() ?>


</div>

<?php
Modal::begin([
    'title' => 'Создать',
    // 'toggleButton' => ['label' => 'click me'],
    'options' => [
        'id' => 'create-modal',
    ],
]);

echo $this->render('create',[
    'model' => $model,
]);

Modal::end();

?>