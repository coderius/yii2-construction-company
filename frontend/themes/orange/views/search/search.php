<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

// echo $queryString;

?>
<!-- header -->
<div class="page-header">
    <div class="container">
        <div class="row crumbs-box">
            <div class="col-12">
                <h2>"<?= $queryString; ?>"</h2>
            </div>

            <div class="col-12">
                <a href="<?= Url::home(); ?>">Главная</a>
                <span data-toggle="tooltip" data-placement="bottom" title="Вы тут ...">Поиск: "<?= $queryString; ?>"</span>
            </div>
        </div>
    </div>
</div>
<!-- ./header -->

<div class="blog">
    <?php $i = 0; ?>
    <?php
        $widget = ListView::begin([
            'dataProvider' => $dataProvider,
            'pager' => [
                'pageCssClass' => 'page-item',
                'activePageCssClass' => 'active',
                'disabledPageCssClass' => 'disabled',
                'firstPageLabel' => 'Вначало',
                'lastPageLabel' => 'Вконец',
                'firstPageCssClass' => 'first page-item',
                'disabledPageCssClass' => 'desibled page-item',
                'maxButtonCount' => 6,
                'options' => [
                    'class' => 'pagination justify-content-center',
                ],
                'linkOptions' => [
                    'class' => 'page-link',
                ],
            ],
            'itemView' => function ($model, $key, $index, $widget) use (&$i) {
                ++$i;

                return $this->render('_material-list', ['model' => $model, 'show' => in_array($i, [1, 3, 4, 6])]);
            },
            'options' => [
                    // 'class' => 'row blog-page',
            ],
            'itemOptions' => [
                'tag' => false,
            ],
            'summary' => '',
        ]);
    ?>


    <div class="about wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <h3 class="col-lg-12 text-center">Всего результатов: <?= $dataProvider->getTotalCount(); ?></h3>
                <?php echo $widget->renderItems(); ?>
            </div>
        </div>
    </div>

    <!-- pagination -->
    <div class="row">
        <div class="col-12">
            <?php echo $widget->renderPager(); ?>
        </div>
    </div>
    <!-- ./pagination -->
</div>

