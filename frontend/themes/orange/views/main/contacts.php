<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\bootstrap4\Modal;
use yii\helpers\Html;

//Fake send message hendler
$urlSendEmail = Url::to(['send-email']);

$js = <<< JS

var button = $('#sendMessageButton');
var myAlert = $('.alert-success');
var spinner = button.find('#my-spinner');

myAlert.removeClass('show');

// formValidationClear($('#contactForm'), '.text-danger');

button.on('click', function(e){
    e.preventDefault();
    spinner.toggleClass('invisible');
    var form = $('#contactForm');
    // console.log(form.serializeArray());
    $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serializeArray()
        })
        // .then(function(result){
        //     console.log(result);
        // })
        .done(function(data){
            if(data.success) {
                formValidationClear(form, '.text-danger');
                formDataClear(form);
                myAlert.addClass('show');
            } else if (data.validation) {
                formValidationClear(form, '.text-danger');
                validationMessages(form, data.validation)
            } else {
                // incorrect server response
            }
            spinner.toggleClass('invisible');
        });

    // setTimeout(
    //     function(){
    //         spinner.toggleClass('invisible');
    //         myAlert.addClass('show');
    //     },
    //     3000
    // );
});

function validationMessages(form, data){
    // console.log(data);
    $.each(data, function( index, messages ){
        // var name = "ContactForm[" + index + "]";
        var input = form.find("[name='"+index+"']");
        var invalidFeedback = input.next('.text-danger');
        invalidFeedback.css("display", "block");
        messages.map(function(item) {
            invalidFeedback.append( "<p>"+ item +"</p>" );
            console.log(item);
        });
        // console.log(invalidFeedback);
    });
}

function formValidationClear(form, invalidFeedbackSelector){
    form.find(invalidFeedbackSelector).each(function () {
        // console.log($(this));
        $(this).empty();
    });
}

function formDataClear(form){
    var clear = function(){
        form.find("input[type=text], textarea, input[type=email]").val("").each(function () {
            $(this).val("");
        });
    };
    clear();
}

JS;

$this->registerJs($js);

?>

<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Наши контакты</h2>
            </div>
            <div class="col-12">
                <a href="<?= Url::home(); ?>">Главная</a>
                <span data-toggle="tooltip" data-placement="bottom" title="Вы тут ...">Контакты</span>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Contact Start -->
<div class="contact wow fadeInUp">
    <div class="container">
        <div class="section-header text-center">
            <p>Связаться</p>
            <h2>Мы рады Вашему звонку</h2>
        </div>

        <div class="alert alert-success show fade">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size:20px">×</span>
        </button>
            <strong>Спасибо!</strong> Сообщение отправлено. Постараемся в ближайшее время его рассмотреть...
        </div>

        <div class="row">
            <?php if($model): ?>
            <div class="col-md-6">
                <div class="contact-info">
                <?php foreach($model as $item): ?>
                    <div class="contact-item">
                        <?= $item->icon1; ?>
                        <div class="contact-text">
                            <h2><?= $item->title; ?></h2>
                            <?php if($item->hasContacts()): ?>
                                <?php foreach($item->makeContacts() as $c): ?>
                                <p><?= $c; ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>


            <div class="col-md-6">
                <div class="contact-form">
                    <div id="success"></div>
                    <form method="post" name="sentMessage" id="contactForm" novalidate="novalidate" action="<?= Url::toRoute('send-email'); ?>">
                        <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
                        <div class="control-group">
                            <input type="text" class="form-control" name="name" placeholder="Ваше имя" required="required" data-validation-required-message="Напишите Ваше имя" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" name="email" placeholder="Ваш Email" required="required" data-validation-required-message="Напишите Ваш email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="subject" placeholder="Тема" required="required" data-validation-required-message="Пожалуйста, введите тему сообщения" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" name="message" placeholder="Сообщение" required="required" data-validation-required-message="Напишите Ваше сообщение"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn" type="submit" id="sendMessageButton">
                            Отправить сообщение
                            <div id="my-spinner" class="spinner-border text-muted invisible"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php
Modal::begin([
    'title' => 'Спасибо.',
    'options' => [
        'id' => 'message',
    ],
]);

echo 'Сообщение отправлено. Постараемся в ближайшее время его рассмотреть...';

Modal::end();

?>