<?php

/**
 * @package myblog
 * @file _admin-panel.php created 11.08.2018 16:56:44
 * 
 * @copyright Copyright (C) 2018 Sergio coderius <coderius>
 * @license This program is free software: GNU General Public License
 */
use common\enum\BlogEnum;
use yii\helpers\Html;
use yii\helpers\Url;

//var_dump(Yii::$app->request->queryParams['alias']);

?>
&nbsp;&nbsp; <a title="Вход" class="color-wite" onmouseover="this.style.color='white';" onmouseout="this.style.color='#555';" href="<?= Yii::$app->urlManagerBackend->createUrl(['admin/index']); ?>">Админ часть</a>
&nbsp;&nbsp; 
<?php //echo Html::tag('span', BlogArticles::$statusesName[$model->flagActive],['class' => 'label label-' . ($active ? 'success' : 'danger'),]); ?>



