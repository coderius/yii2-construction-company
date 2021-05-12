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

?>

<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?= $heading; ?></h2>
            </div>
            <div class="col-12">
                <a href="<?= Url::home(); ?>">Главная</a>
                <a href="<?= Url::toRoute(['/portfolios']); ?>"><?= $crumbNamePortfolio; ?></a>
                <span data-toggle="tooltip" data-placement="bottom" title="Вы тут ..."><?= $crumbName; ?></span>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

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
    $i++;
    return $this->render('_material-list',[
      'model' => $model,
      'show' => in_array($i, [1,3,4,6]),
    ]);

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
<div class="portfolio">
  <div class="container">
      <div class="section-header text-center">
          <p><?= $heading2; ?> <span class="text-info"> / Кол-во: (<?= $dataProvider->getTotalCount(); ?>)</span></p>
          <h2><?= $heading3; ?></h2>
      </div>
      <div class="row portfolio-container">
      <?php echo $widget->renderItems(); ?>
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