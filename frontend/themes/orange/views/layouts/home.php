<?php
/* @var $this yii\web\View */

use common\widgets\widgetLayout\WidgetLayout;

// var_dump($this->params['WidgetLayout']['template']);
?>

<?php $this->beginContent('@frontend/themes/orange/views/layouts/main.php'); ?>

<?php WidgetLayout::begin([
    'params' => [
        'template' => $this->params['WidgetLayout']['template']
    ]
]); ?>

<?= $content ?>

<?php WidgetLayout::end(); ?>

<?php $this->endContent(); ?>