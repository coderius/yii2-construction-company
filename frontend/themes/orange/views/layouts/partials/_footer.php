<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;


?>
<!-- Footer Start -->
<div class="footer wow fadeIn" data-wow-delay="0.3s">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="footer-contact">
                    <h2>Контакты</h2>
                    <?php foreach($this->params['SiteLayout']['footer']['contacts'] as $contact): ?>
                        <p>
                        <?= $contact->icon2; ?>
                        <?php foreach($contact->makeContacts() as $c): ?>
                        <?= $c; ?>
                        <?php endforeach; ?>
                        </p>
                    <?php endforeach; ?>
                    <!-- <div class="footer-social">
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-youtube"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                    </div> -->
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer-link-not-anim">
                    <h2>Последнее в блоге</h2>
                    <?php foreach($this->params['SiteLayout']['footer']['blog'] as $item): ?>
                    <a href="<?= Url::toRoute(['blog/article/' . $item->alias]); ?>"><?= $item->header1; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer-link">
                    <h2>Полезные страницы</h2>
                    <?php foreach($this->params['SiteLayout']['footer']['menu'] as $item): ?>
                    <a href="<?= Url::toRoute([$item->alias]); ?>"><?= $item->name; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="newsletter">
                    <h2>Совет дня</h2>
                    <p>
                        Начинайте ремонт из дальней не проходной комнаты. А прихожей - в конце. Тогда ремонт меньше затронет уже сделанные участки квартиры.
                    </p>
                    <!-- <div class="form">
                        <input class="form-control" placeholder="Email here">
                        <button class="btn">Submit</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container footer-menu">
        <div class="f-menu">
            <a href="">Terms of use</a>
            <a href="">Privacy policy</a>
            <a href="">Cookies</a>
            <a href="">Help</a>
            <a href="">FQAs</a>
        </div>
    </div> -->
    <div class="container copyright">
        <div class="row">
            <div class="col-md-6">
                <p><a href="<?= Url::home(); ?>"><?= Yii::$app->name; ?></a> &copy; Все права защищены.</p>
            </div>
            <!-- <div class="col-md-6">
                <p>Разработано <a href="https://htmlcodex.com">HTML Codex</a></p>
            </div> -->
        </div>
    </div>
</div>
<!-- Footer End -->