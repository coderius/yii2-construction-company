<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\services\portfolio\PortfolioService;

// var_dump($tags == null);die;

?>

<div class="col-12">
    <ul id="portfolio-flters" class="tags-filters">
        <li class="<?= PortfolioService::isCurrentUrlStyle(Url::toRoute(['portfolios/'])); ?>"
            data-toggle="tooltip"
            data-placement="top"
            title="<?= $allCount; ?>"
        >
            <?= Html::a("Все", ['portfolios/'], ['class' => '']); ?>
        </li>
        <?php if($tags): ?>
            <?php foreach($tags as $tag): ?>
                <?= PortfolioService::isCurrentUrlStyle(Url::toRoute(['portfolios/tag/' . $tag->alias]));?>
            <li class="<?= PortfolioService::isCurrentUrlStyle(Url::toRoute(['portfolios/tag/' . $tag->alias]));?>"
                data-toggle="tooltip" 
                data-placement="top" 
                title="<?= $tag->surrogatePortfolioCategoriesCount;?>"
            >
                <?= Html::a($tag->header, ['portfolios/tag/' . $tag->alias], ['class' => '']); ?>
            </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>