<?php
/* @var $this \yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

function isCurrentUrlStyle($url){
    return $url === Url::to('') ? 'active' : '';
}
// var_dump(isCurrentUrlStyle(Url::home()));

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
                    <a href="<?= Url::home(true); ?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::home());?>">Home</a>
                    <a href="<?= Url::toRoute(['/about']);?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::toRoute(['/about']));?>">About</a>
                    <a href="<?= Url::toRoute(['/service']);?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::toRoute(['/service']));?>">Service</a>
                    <a href="<?= Url::toRoute(['/team']);?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::toRoute(['/team']));?>">Team</a>
                    <a href="<?= Url::toRoute(['/portfolio']);?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::toRoute(['/portfolio']));?>">Portfolio</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Blog</a>
                        <div class="dropdown-menu">
                            <a href="<?= Url::toRoute(['/blog']);?>" class="dropdown-item">All blog</a>
                            <a href="<?= Url::toRoute(['/blog/category', 'alias' => 'some_alias']);?>" class="dropdown-item">Category of blog</a>
                            <a href="<?= Url::toRoute(['/blog/category', 'alias' => 'some_alias']);?>" class="dropdown-item">Category of blog</a>
                            <a href="<?= Url::toRoute(['/blog/category', 'alias' => 'some_alias']);?>" class="dropdown-item">Category of blog</a>
                            <a href="<?= Url::toRoute(['/blog/category', 'alias' => 'some_alias']);?>" class="dropdown-item">Category of blog</a>
                        </div>
                    </div>
                    <a href="<?= Url::toRoute(['/contact']);?>" class="nav-item nav-link <?= isCurrentUrlStyle(Url::toRoute(['/contact']));?>">Contact</a>
                </div>
                <div class="ml-auto">
                    <a class="btn" href="#">Get A Quote</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->