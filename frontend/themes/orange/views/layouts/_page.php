<?php
/* @var $this yii\web\View */

use common\widgets\widgetLayout\WidgetLayout;
use yii\helpers\Url;

$js = <<< JS
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
JS;
$this->registerJs($js);

?>

<?php $this->beginContent('@frontend/themes/orange/views/layouts/main.php'); ?>

<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row crumbs-box">
            <div class="col-12">
                <h2><?= $this->params['PageLayout']['h2']; ?></h2>
            </div>
            
            <div class="col-12">
                <a href="<?= Url::home(); ?>">Главная</a>
                <span data-toggle="tooltip" data-placement="bottom" title="Вы тут ..."><?= $this->params['PageLayout']['crumbCurrentTitle']; ?></span>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<?php WidgetLayout::begin([
    'params' => [
        'template' => $this->params['WidgetLayout']['template']
    ]
]); ?>

<?= $content ?>

<?php WidgetLayout::end(); ?>

<?php $this->endContent(); ?>