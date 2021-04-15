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

// var_dump($dataProvider->getModels());die;

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
    return $this->render('_material-list',['model' => $model, 'show' => in_array($i, [1,3,4,6]) ]);

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
          <p><?= $header1; ?></p>
          <h2><?= $header2; ?></h2>
      </div>
      <div class="row">
        <?= $this->render('_tags', compact('tags', 'allCount')); ?>
      </div>
      <div class="row portfolio-container">
      <?php echo $widget->renderItems(); ?>
          <!-- <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
              <div class="portfolio-warp">
                  <div class="portfolio-img">
                      <img src="img/portfolio-1.jpg" alt="Image">
                      <div class="portfolio-overlay">
                          <p>
                              Lorem ipsum dolor sit amet elit. Phasel nec pretium mi. Curabit facilis ornare velit non. Aliqu metus tortor, auctor id gravi condime, viverra quis sem.
                          </p>
                      </div>
                  </div>
                  <div class="portfolio-text">
                      <h3>Project Name</h3>
                      <a class="btn" href="img/portfolio-1.jpg" data-lightbox="portfolio">+</a>
                  </div>
              </div>
          </div> -->
          <!-- <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item second wow fadeInUp" data-wow-delay="0.2s">
              <div class="portfolio-warp">
                  <div class="portfolio-img">
                      <img src="img/portfolio-2.jpg" alt="Image">
                      <div class="portfolio-overlay">
                          <p>
                              Lorem ipsum dolor sit amet elit. Phasel nec pretium mi. Curabit facilis ornare velit non. Aliqu metus tortor, auctor id gravi condime, viverra quis sem.
                          </p>
                      </div>
                  </div>
                  <div class="portfolio-text">
                      <h3>Project Name</h3>
                      <a class="btn" href="img/portfolio-2.jpg" data-lightbox="portfolio">+</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item third wow fadeInUp" data-wow-delay="0.3s">
              <div class="portfolio-warp">
                  <div class="portfolio-img">
                      <img src="img/portfolio-3.jpg" alt="Image">
                      <div class="portfolio-overlay">
                          <p>
                              Lorem ipsum dolor sit amet elit. Phasel nec pretium mi. Curabit facilis ornare velit non. Aliqu metus tortor, auctor id gravi condime, viverra quis sem.
                          </p>
                      </div>
                  </div>
                  <div class="portfolio-text">
                      <h3>Project Name</h3>
                      <a class="btn" href="img/portfolio-3.jpg" data-lightbox="portfolio">+</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first wow fadeInUp" data-wow-delay="0.4s">
              <div class="portfolio-warp">
                  <div class="portfolio-img">
                      <img src="img/portfolio-4.jpg" alt="Image">
                      <div class="portfolio-overlay">
                          <p>
                              Lorem ipsum dolor sit amet elit. Phasel nec pretium mi. Curabit facilis ornare velit non. Aliqu metus tortor, auctor id gravi condime, viverra quis sem.
                          </p>
                      </div>
                  </div>
                  <div class="portfolio-text">
                      <h3>Project Name</h3>
                      <a class="btn" href="img/portfolio-4.jpg" data-lightbox="portfolio">+</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item second wow fadeInUp" data-wow-delay="0.5s">
              <div class="portfolio-warp">
                  <div class="portfolio-img">
                      <img src="img/portfolio-5.jpg" alt="Image">
                      <div class="portfolio-overlay">
                          <p>
                              Lorem ipsum dolor sit amet elit. Phasel nec pretium mi. Curabit facilis ornare velit non. Aliqu metus tortor, auctor id gravi condime, viverra quis sem.
                          </p>
                      </div>
                  </div>
                  <div class="portfolio-text">
                      <h3>Project Name</h3>
                      <a class="btn" href="img/portfolio-5.jpg" data-lightbox="portfolio">+</a>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item third wow fadeInUp" data-wow-delay="0.6s">
              <div class="portfolio-warp">
                  <div class="portfolio-img">
                      <img src="img/portfolio-6.jpg" alt="Image">
                      <div class="portfolio-overlay">
                          <p>
                              Lorem ipsum dolor sit amet elit. Phasel nec pretium mi. Curabit facilis ornare velit non. Aliqu metus tortor, auctor id gravi condime, viverra quis sem.
                          </p>
                      </div>
                  </div>
                  <div class="portfolio-text">
                      <h3>Project Name</h3>
                      <a class="btn" href="img/portfolio-6.jpg" data-lightbox="portfolio">+</a>
                  </div>
              </div>
          </div> -->
      </div>
      <!-- <div class="row">
          <div class="col-12 load-more">
              <a class="btn" href="#">Load More</a>
          </div>
      </div> -->
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