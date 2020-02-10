<?php

use yii\web\Request;

$baseUrl = str_replace('/frontend/web', '', (new Request())->getBaseUrl());
$baseUrl = str_replace('/backend/web', '', $baseUrl);

return [
    'aliases' => require(__DIR__.'/aliases.php'),
    'name' => 'Masters site',
    'language' => 'ru-RU',
    'timeZone' => 'Europe/Kiev',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'myRequest' => [
            'class' => 'common\components\web\Request', //мой компонент
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\user\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-user',
                'httpOnly' => true],
        ],
        // перевод
        'i18n' => [
            'translations' => [
                'blog*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    //'sourceLanguage' => 'en-US',
                    'forceTranslation' => true,
                    'fileMap' => [
                        'blog-main' => 'blog.php',
                    ],
                ],

                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    //'sourceLanguage' => 'en-US',
                    'forceTranslation' => true,
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                        'app/admin' => 'admin.php',
                    ],
                ],
                'auth*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    //'sourceLanguage' => 'en-US',
                    'forceTranslation' => true,
                    'fileMap' => [
                        'auth' => 'auth.php',
                        'auth/error' => 'error.php',
                        'auth/admin' => 'admin.php',
                    ],
                ],
            ],
        ],
        //формат даты
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'ru-RU', //язык русский
            'defaultTimeZone' => 'UTC', //точка отсчета
            'timeZone' => 'Europe/Kiev',
//            'timeZone' => Yii::$app->user->isGuest ? 'UTC' : Yii::$app->user->identity->timezone,

            //'dateFormat' => 'd MMMM yyyy',//как месяц
            'dateFormat' => 'dd.MM.yyyy', // как число
        ],

        //для ссылок в админки во фронт и на оборот
        'urlManagerFrontend' => require(dirname(dirname(__DIR__)).'/frontend/config/urlmanager.php'),
        'urlManagerBackend' => require(dirname(dirname(__DIR__)).'/backend/config/urlmanager.php'),

    ],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
        //  'allowedIPs' => ['127.0.0.1', '::1']
        ],
    ],
    'bootstrap' => [
        'common\components\events\EventBootstrap',
    ],
];
