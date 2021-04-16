<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$js = <<< JS
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
JS;
$this->registerJs($js);

// var_dump($allCount);die;

?>
<?php $i = 0; ?>
<?php $widget = ListView::begin([
'dataProvider' => $dataProvider,
'pager'        => [
    'pageCssClass' => 'page-item',
    'activePageCssClass' => 'active',
    'disabledPageCssClass' => 'disabled',
    'firstPageLabel' => 'Вначало',
    'lastPageLabel' => 'Вконец',
    'firstPageCssClass'=>'first page-item',
    'disabledPageCssClass'=>'desibled page-item',
    'maxButtonCount' => 6,
    'options' =>  [
        'class' => 'pagination justify-content-center',
    ],
    'linkOptions' =>  [
        'class' => 'page-link',
    ],
],
// 'itemView' => '_material-list',
'itemView' => function ($model, $key, $index, $widget) use(&$i) {
    // $i = 0;
    $i++;
    return $this->render('_category-list',['model' => $model, 'show' => in_array($i, [1,3,4,6]) ]);

    // or just do some echo
    // return $model->title . ' posted by ' . $model->author;
},
// 'options' =>  [
//         'class' => 'row blog-page',
// ],
'itemOptions' => [
    'tag' => false,
],
'summary' => '',
]);
?>


<!-- Portfolio Start -->
<div class="portfolio blog">
  <div class="container">
      <div class="section-header text-center">
          <p><?= $header1; ?> <span class="text-info"> / Кол-во: (<?= $dataProvider->getTotalCount(); ?>)</span></p>
          <h2><?= $header2; ?></h2>
      </div>
      
      <div class="row">
        <?= $this->render('_tags', compact('tags', 'allCount')); ?>
      </div>

        <div class="row blog-page">
        <?php if($dataProvider->getTotalCount() > 0): ?>
          <?php echo $widget->renderItems(); ?>
        <?php else: ?>
          <div class="col-sm-12 portfolio-item first wow fadeInUp" data-wow-delay='0.2s'>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Пока ничего нет...</strong>
            </div>
          </div>
        <?php endif; ?>
        </div>
      
      <!-- pagination -->
      <div class="row">
            <div class="col-12">
                <?php echo $widget->renderPager(); ?>
            </div>
        </div>
        <!-- ./pagination -->
  </div>
</div>
  <!-- Portfolio End -->