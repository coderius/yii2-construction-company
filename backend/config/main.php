<?php

use \yii\web\Request;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'homeUrl' => (new Request)->getBaseUrl().'/admin/index',//for \Yii::$app->getHomeUrl() or $this->goHome()
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-user',
            'baseUrl' => $baseUrl.'/backend/web',
            'cookieValidationKey' => 'sgtjngjgkl,mnbcxvzcvbnjjjh7654hgbbvc',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-site',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'ru-RU',
            'timeZone' => 'Europe/Kiev', // +4 UTC
            //нужен для конвертации дат в локальное время. 
            //В базе сохраняем с помощью gmdate("Y-m-d H:i:s"). 
            //Потом в виде выводим  \Yii::$app->formatter->asDateTime($model->updatedAt). 
            //Если не устанавливать тут свойство, то тогда в виде выводим  \Yii::$app->formatter->asDateTime($model->updatedAt. " UTC"). 
            //Если нужно где-то в приложении поменять временную зону, то меняем так \Yii::$app->timeZone = 'Europe/Kiev';
            'defaultTimeZone' => 'UTC',
            'dateFormat' => 'd MMMM yyyy',//как месяц
            //'dateFormat' => 'dd.MM.yyyy',// как число
            'datetimeFormat' => 'php:n F Y в H:i',
            'timeFormat' => 'H:i:s',
        ],
        'request' => [
            'csrfParam' => '_csrf-user',
            'baseUrl' => $baseUrl.'/backend/web',
            'cookieValidationKey' => 'sgtjngjgkl,mnbcxvzcvbnjjjh7654hgbbvc',
        ],
        'urlManager' => require(__DIR__ . '/urlmanager.php'),
    ],
    'params' => $params,
];
