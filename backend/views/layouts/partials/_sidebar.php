<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::home(true); ?>" class="brand-link">
      <img src="<?= Yii::getAlias('@backend-web-adminlte');?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= Yii::$app->name; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= Yii::getAlias('@backend-web-adminlte');?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= \Yii::$app->user->identity->username; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Блог -->
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Блог
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/blog-article/index']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Обзор</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/blog-article/create']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
              </ul>
          </li>
          <!-- ./Блог -->

          <!-- Категории блога -->
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Категории блога
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/blog-category/index']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Обзор</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/blog-category/create']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
              </ul>
          </li>
          <!-- ./Категории блога -->

          <!-- Страницы -->
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Страницы
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/page/index']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Обзор</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/page/create']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
              </ul>
          </li>
          <!-- ./Страницы -->

           <!-- Portfolio -->
           <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Портфолио фото
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/portfolio/index']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Обзор</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/portfolio/create']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
              </ul>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Категории портфолио
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/portfolio-category/index']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Обзор</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/portfolio-category/create']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
              </ul>
          </li>
          <!-- ./Portfolio -->

          <!-- Теги -->
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Теги
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/tag/index']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Обзор</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/tag/create']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
              </ul>
          </li>
          <!-- ./Теги -->

          <!-- Контакты -->
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
              Контакты
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/contacts/index']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Обзор</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/contacts/create']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
              </ul>
          </li>
          <!-- ./Контакты -->

          <!-- Верхнее меню -->
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
              Верхнее меню
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/menu-top/index']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Обзор</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/menu-top/create']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
              </ul>
          </li>
          <!-- ./Верхнее меню -->

          <!-- Юзеры-->
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
              Юзеры
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/user-manage/index']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Обзор</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute(['/user-manage/create']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Создать</p>
                </a>
              </li>
              </ul>
          </li>
          <!-- ./Юзеры -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>