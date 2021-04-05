<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\widgets\IosStyleToggleSwitch\IosStyleToggleSwitchWidget;
use dosamigos\tinymce\TinyMce;
use yii\web\JsExpression;
use yii\helpers\Url;
use dosamigos\fileinput\BootstrapFileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\BlogArticle */
/* @var $form yii\widgets\ActiveForm */
?>


<!-- viewCoutn, createdAt, createdBy, img -->
<div class="blog-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metaTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metaDesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header1')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'file')
                ->fileInput()
                ->widget(BootstrapFileInput::classname(), [
                        'options' => ['accept' => 'image/*'],
                        'clientOptions'=>[
                            'allowedFileExtensions'=>['jpg','gif','png'],
                            'showUpload' => false,
                            'dropZoneEnabled' => false,
                            'initialPreview'=> $model->isNewRecord ? false :
                                [
                                    Html::img("@img-web-blog-posts/{$model->id}/middle/{$model->faceImg}", ['style'=>'width: 100%; height: auto;', 'alt'=>'нет изображения', 'title'=>$model->faceImgAlt]),//картинка ,которая уже загружена у обновляемой записи
                                ],
                            'maxFileSize'=>4000,
                            'minImageWidth'=> 600,
                            'minImageHeight'=> 300,
                        ],
                                                ]);


    ?>

    <?php 
    $urlUploadTinymce = Url::to(['uploadImgTinymce']);
    $urlDeleteTinymce = Url::to(['deleteImgTinymce']);
    $csrf_param = \Yii::$app->request->csrfParam; 
    $csrf_token = \Yii::$app->request->csrfToken;
    
    ?>
    
    <?= $form->field($model, 'text')->widget(TinyMce::className(), [
    'options' => ['rows' => 12],
    'language' => 'ru',
       
    'clientOptions' => [

        //set br for enter
        'force_br_newlines' => true,
        'force_p_newlines' => false,
        'forced_root_block' => '',
        'relative_urls' => false,

        //вырезаем картинку и удаляем с папки
        'init_instance_callback' => new JsExpression("function (editor) {
                editor.on('GetContent', function (e) {
                    var regex = /src\s?=\s?['|\"]((.*?))['|\"]/i;
                    var src = regex.exec(e.content);
                    var issetImg = ( e.content.search(/img\s(.*?)src/i) != -1 );

                    if(issetImg && src){
                        console.log(src[1]);
                        tinymce.activeEditor.windowManager.confirm('Удалить картинку с сервера?', function(s) {
                            if (s){
                            console.log(s);
                                
                                $.ajax({
                                    'type' : 'POST',
                                    'url' : '".$urlDeleteTinymce."',
                                    'dataType' : 'json',
                                    'data' : {src: src[1],'$csrf_param': '$csrf_token'},

                                    'success' : function(data){
                                            tinymce.activeEditor.windowManager.alert(data.message);


                                    },
                                    'error' : function(request, status, error){
                                            console.log(\"ошибка\");
                                            console.log(status);
                                            console.log(error);
                                    }
                                });
                               
                               
                            }else{
                               tinymce.activeEditor.windowManager.alert('Отменено');
                                tinymce.activeEditor.undoManager.undo();
                                return;

                            }   
                               
                        });

                    }

                });    
            }        
        "),
        
        // Добавляем свою кнопку
        'setup'=> new JsExpression("function(ed) {

           //добавление своей кнопки
            ed.ui.registry.addButton('my-codeblock', {
                title: 'код',
                text: 'Код',
                onAction: function() {

                    var selected = ed.selection.getContent({format : 'html'});

                    if(ed.selection.getNode().nodeName == 'CODE')
                    {
                        tinyMCE.execCommand('mceReplaceContent',false,selected);

                    }
                    else
                    {
                        tinyMCE.execCommand('mceReplaceContent',false, ' <code>' + selected + '</code> ');
                    }
                    
                },



            });


        }
    "),    
        
        'images_upload_handler' => new JsExpression("
                function (blobInfo, success, failure) {
                    formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    formData.append('$csrf_param', '$csrf_token');
//                    console.log(formData);
                    $.ajax({
                        'type' : 'POST',
                        'url' : '".$urlUploadTinymce."',
                        'dataType' : 'json',
                        cache: false,
                        processData: false,
                        contentType: false,
                        'data' : formData,
                        
                        'success' : function(data){
                                var dLoc = data.location;
                                console.log(dLoc);
//                                tinymce.activeEditor.insertContent('<img class=\"content-img\" src=\"' + dLoc + '\"/>');
                                success(dLoc);
                            
                                
                        },
                        'error' : function(request, status, error){
                                console.log(\"ошибка\");
                                console.log(status);
                                console.log(error);
                        }
                    });


                }
                
        "),
//        "images_upload_url" => Url::to(['ajax-upload-img-tinymce']),
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste image imagetools nonbreaking",
            "codesample",
            "textcolor colorpicker"
        ],
        
        'menubar'=> ["insert"],
        'automatic_uploads' => true,
        'file_picker_types'=> 'image',
        
        'toolbar' => "codesample | my-codeblock | undo redo | styleselect | bold italic | h1 | h2| h3 | h4 | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link anchor image imageupload | fontselect | cut copy paste | nonbreaking | fullscreen | code | forecolor backcolor",
        'codesample_dialog_height' => new JsExpression("$( window ).height()"),//for codesample
        "codesample_languages"=> new JsExpression("[
            {text: 'PHP', value: 'php'},
            {text: 'HTML/XML', value: 'markup'},
            {text: 'JavaScript', value: 'javascript'},
            {text: 'CSS', value: 'css'}
        ]"),
        'nonbreaking_force_tab' => true,//разрешить табы
        'image_advtab' => true,
        'image_title'=> true,
        
//        'formats' => new JsExpression("{}"),
        
        //добавляем свои наборы стилей на панель
        'style_formats'=> new JsExpression("[{title: 'Image Left', selector: 'img', styles: {
              'float' : 'left',
              'margin': '0 10px 0 10px'
            }},
            {title: 'Image Right', selector: 'img', styles: {
              'float' : 'right',
              'margin': '0 10px 0 10px'
            }},
            
            {title: 'Code', block: 'code', 
//            wrapper: true
            },
            
            {title: 'Text/Typography', items: [
                {title: 'mark', inline: 'mark'},
                {title: 'Blockquote', block: 'Blockquote', wrapper: true},
                {title: 'Blockquote-reverse', block: 'Blockquote', classes: 'blockquote-reverse', wrapper: true},
                {title: 'kbd', inline: 'kbd'},
                {title: 'text-muted', inline: 'span', classes: 'text-muted'},
                {title: 'text-primary', inline: 'span', classes: 'text-primary'},
                {title: 'text-success', inline: 'span', classes: 'text-success'},
                {title: 'text-info', inline: 'span', classes: 'text-info'},
                {title: 'text-warning', inline: 'span', classes: 'text-warning'},
                {title: 'text-danger', inline: 'span', classes: 'text-danger'},
            ]},

            {title: 'Blocks Callout', items: [
                {title: 'Callout default', block: 'div', classes: 'bs-callout bs-callout-default', wrapper: true},
                {title: 'Callout success', block: 'div', classes: 'bs-callout bs-callout-success', wrapper: true},
                {title: 'Callout Info', block: 'div', classes: 'bs-callout bs-callout-info', wrapper: true},
                {title: 'Callout warning', block: 'div', classes: 'bs-callout bs-callout-warning', wrapper: true},
                {title: 'Callout danger', block: 'div', classes: 'bs-callout bs-callout-danger', wrapper: true},
            ]},

            {title: 'Blocks Alert', items: [
                {title: 'Alert success', block: 'div', classes: 'alert alert-success', wrapper: true},
                {title: 'Alert Info', block: 'div', classes: 'alert alert-info', wrapper: true},
                {title: 'Alert warning', block: 'div', classes: 'alert alert-warning', wrapper: true},
                {title: 'Alert danger', block: 'div', classes: 'alert alert-danger', wrapper: true},
            ]},


            {title: 'Blocks', items: [
                {title: 'Paragraph', format: 'p'},
                {title: 'Blockquote', format: 'blockquote'},
                {title: 'Div', format: 'div'},
                {title: 'Pre', format: 'pre'}
              ]},
            ]"),
        
        
    ]
]); ?>


    <?php 
    echo $form->field($model, 'status')->widget(IosStyleToggleSwitchWidget::class, [
        'type' => IosStyleToggleSwitchWidget::CHECKBOX
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
