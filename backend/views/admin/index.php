<?php
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Главная страница админчасти.';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Админчасть!</h1>

<!--        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Блог</h2>

                <p>
                    <span class="h4 text-muted">Страницы блога</span>
                    <a class="btn btn-info btn-xs" href="<?= Url::toRoute(['/blog-articles/index']); ?>">Перейти &raquo;</a>
                </p>

                <p>
                    <span class="h4 text-muted">Категории блога</span>
                    <a class="btn btn-info btn-xs" href="<?= Url::toRoute(['/blog-categories/index']); ?>">Перейти &raquo;</a>
                </p>
                
                <p>
                    <span class="h4 text-muted">Серии статей блога</span>
                    <a class="btn btn-info btn-xs" href="<?= Url::toRoute(['/blog-series/index']); ?>">Перейти &raquo;</a>
                </p>
                
                <p>
                    <span class="h4 text-muted">Теги для статей блога</span>
                    <a class="btn btn-info btn-xs" href="<?= Url::toRoute(['/blog-tags/index']); ?>">Перейти &raquo;</a>
                </p>
                
            </div>

            
            <div class="col-lg-6">
                <h2>Фрагменты</h2>

                <p>
                    <span class="h4 text-muted">Верхнее меню</span>
                    <a class="btn btn-info btn-xs" href="<?= Url::toRoute(['/navigation-top/index']); ?>">Перейти &raquo;</a>
                </p>

                
                
            </div>
            
        </div>
        
        


            
        
        
        

    </div>
</div>
