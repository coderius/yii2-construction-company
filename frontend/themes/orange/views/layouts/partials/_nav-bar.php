<?php
/* @var $this \yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use common\components\rbac\Rbac;

function isCurrentUrlStyle($url){
    return $url === Url::to('') ? 'active' : '';
}
// var_dump($this->params['SiteLayout']['top-bar']);
// var_dump(\Yii::$app->authManager->getAssignments(1));
//     PHP_EOL;

$bar = $this->params['SiteLayout']['top-bar'];

$urlAutoComplete = Url::to(['/auto-complete']);
$urlSearch = Url::to(['/search']);

$js = <<< JS
var searchResultbox = $('#search-resultbox');
var inputSearch = $('#search');

inputSearch.on("input", function(e) {
    var dInput = this.value;

    // console.log(dInput);

    if(this.value){
        $.ajax({
            type: "POST",
            url: "$urlAutoComplete",
            data: { query: dInput }
        })
        .done(function(data){
            // console.log(data);
            if(data.success) {
                searchResultbox.empty();
                var res = data.success;
                res.forEach(function(item) {
                    searchResultbox.append("<a href='$urlSearch?q=" + item.name + "'>" + item.name + "</a>");
                });

                // searchResultbox.html(data.success);
                console.log(res);
            }
            else {
                searchResultbox.html("<p> Нет результатов... </p>");
                // searchResultbox.append("<p> Нет результатов... </p>");
            }
            // else {
            //     searchResultbox.html('Нет результатов...');
            // }
        })
        .fail(function () {
            // request failed
        });
    }else{
        searchResultbox.empty();
    }


});

JS;

$this->registerJs($js);

?>
<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                <?php foreach($bar as $item): ?>
                <?php if($item->hasChildren()): ?>
                    <div class="nav-item dropdown">
                        <a href="<?= Url::toRoute([$item->alias]);?>" class="nav-link dropdown-toggle <?= isCurrentUrlStyle(Url::toRoute([$item->alias]));?>" data-toggle="dropdown"><?= $item->name; ?></a>
                        <div class="dropdown-menu">
                        <?php echo $this->render('_nav-bar-children', ['model' => $item->getChildren()]); ?>
                        </div>
                    </div>

                <?php else: ?>

                    <a href="<?= Url::toRoute([$item->alias]);?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::toRoute([$item->alias]));?>"><?= $item->name; ?></a>
                
                <?php endif; ?>
                <?php endforeach; ?>
                </div>

                <!-- Search Form -->
                <div class="col-sm-2">
                <?= Html::beginForm(['/search/global'], 'get', ['id' => 'search-form', 'class' => 'navbar-form']) ?>
                <div class="nospace">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="q" placeholder="Поиск..." autocomplete="off" value="<?= property_exists($this->context, 'searchQuery') ? Html::encode($this->context->searchQuery) : '' ?>">
                    </div>
                </div>
                <div id="search-resultbox"></div>
                <?= Html::endForm() ?>
                </div>
                <!-- ./Search Form -->

                <div class="ml-auto col-sm-2">
                <div class="navbar-nav mr-auto">
                <?php if (\Yii::$app->user->isGuest): ?>
                    <a href="<?= Url::toRoute(['/login']);?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::toRoute(['/login']));?>"><small>Логин</small></a>
                    <a href="<?= Url::toRoute(['/signup']);?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::toRoute(['/signup']));?>"><small>Регистрация</small></a>

                    <?php else: ?>
                    
                    <a data-method="POST" title="Log Out" href="<?= Url::toRoute(['/logout']);?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::toRoute(['/login']));?>"><small>Выйти</small></a>   
                    
                <?php endif; ?>

                </div>
                    
                </div>
                <!-- <div class="ml-auto">
                    <a class="btn" href="#">Get A Quote</a>
                </div> -->
            </div>
            
        </nav>
        <div class="ml-auto">
        <?php if (!\Yii::$app->user->isGuest): ?>
            <div class="front-user-bar pl-3 text-white">
                <span class="color-wite">Привет,</span> <strong class="color-wite"><?= \Yii::$app->user->identity->username; ?></strong>
                <?php
                if (\Yii::$app->user->can(Rbac::PERMISSION_ADMIN_PANEL)): ?>
                    <?php echo $this->render('_admin-panel'); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        </div>
        
    </div>
</div>
<!-- Nav Bar End -->