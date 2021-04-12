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
                <span data-toggle="tooltip" data-placement="bottom" title="Вы тут ..."><?= $crumbName; ?></span>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Blog Start -->
<div class="blog">
    <div class="container">
        <div class="section-header text-center">
            <p><?= $heading2; ?></p>
            <h2><?= $heading3; ?></h2>
        </div>

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
        'options' =>  [
                'class' => 'row blog-page',
        ],
        'itemOptions' => [
            'tag' => false,
        ],
        'summary' => '',
    ]);
    ?>
        <div class="row blog-page">
        <?php echo $widget->renderItems(); ?>
        </div>

        <!-- <div class="row blog-page">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/blog-1.jpg" alt="Image">
                    </div>
                    <div class="blog-title">
                        <h3>Lorem ipsum dolor sit</h3>
                        <a class="btn" href="">+</a>
                    </div>
                    <div class="blog-meta">
                        <p>By<a href="">Admin</a></p>
                        <p>In<a href="">Construction</a></p>
                    </div>
                    <div class="blog-text">
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/blog-2.jpg" alt="Image">
                    </div>
                    <div class="blog-title">
                        <h3>Lorem ipsum dolor sit</h3>
                        <a class="btn" href="">+</a>
                    </div>
                    <div class="blog-meta">
                        <p>By<a href="">Admin</a></p>
                        <p>In<a href="">Construction</a></p>
                    </div>
                    <div class="blog-text">
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/blog-3.jpg" alt="Image">
                    </div>
                    <div class="blog-title">
                        <h3>Lorem ipsum dolor sit</h3>
                        <a class="btn" href="">+</a>
                    </div>
                    <div class="blog-meta">
                        <p>By<a href="">Admin</a></p>
                        <p>In<a href="">Construction</a></p>
                    </div>
                    <div class="blog-text">
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/blog-1.jpg" alt="Image">
                    </div>
                    <div class="blog-title">
                        <h3>Lorem ipsum dolor sit</h3>
                        <a class="btn" href="">+</a>
                    </div>
                    <div class="blog-meta">
                        <p>By<a href="">Admin</a></p>
                        <p>In<a href="">Construction</a></p>
                    </div>
                    <div class="blog-text">
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/blog-2.jpg" alt="Image">
                    </div>
                    <div class="blog-title">
                        <h3>Lorem ipsum dolor sit</h3>
                        <a class="btn" href="">+</a>
                    </div>
                    <div class="blog-meta">
                        <p>By<a href="">Admin</a></p>
                        <p>In<a href="">Construction</a></p>
                    </div>
                    <div class="blog-text">
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="<?= Yii::getAlias('@web-url-themes/orange/img');?>/blog-3.jpg" alt="Image">
                    </div>
                    <div class="blog-title">
                        <h3>Lorem ipsum dolor sit</h3>
                        <a class="btn" href="">+</a>
                    </div>
                    <div class="blog-meta">
                        <p>By<a href="">Admin</a></p>
                        <p>In<a href="">Construction</a></p>
                    </div>
                    <div class="blog-text">
                        <p>
                            Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                        </p>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- pagination -->
        <div class="row">
            <div class="col-12">
                <?php echo $widget->renderPager(); ?>
                <!-- <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>  -->
            </div>
        </div>
        <!-- ./pagination -->
    </div>
</div>
<!-- Blog End -->