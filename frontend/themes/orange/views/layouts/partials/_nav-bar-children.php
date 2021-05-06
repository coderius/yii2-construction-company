<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php foreach ($model as $m) : ?>
&nbsp;<a href="<?= Url::toRoute([$m->alias]); ?>" class="dropdown-item hoverable"><?= $m->name; ?></a>

<?php if($m->hasChildren()): ?>
<?php echo $this->render('_nav-bar-children', ['model' => $m->getChildren()]); ?>
<?php endif; ?>
<?php endforeach; ?>


