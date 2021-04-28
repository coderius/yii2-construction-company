<?php

use yii\helpers\Html;
use yii\jui\JuiAsset;

?>
<?php foreach($model as $li): ?>
<li id="item-<?= $li->id; ?>" class="ui-sortable-handle"><?= $li->header; ?></li>
<?php endforeach; ?>