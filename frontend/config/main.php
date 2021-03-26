<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'frontend\bootstrap\SetUp',
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-user',
            'baseUrl' => $baseUrl,
            'cookieValidationKey' => 'sdifdbfshbsnstyrfedwety,mnbvcdsfe',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
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
        'urlManager' => require __DIR__ . '/urlmanager.php',

        'view' => [
            'theme' => [
                'class' => yii\base\Theme::className(),
                'basePath' => '@app/themes/orange'    // путь в дир-ию темы
            ],
            'on ' . \yii\base\View::EVENT_BEFORE_RENDER => function($e){
                \Yii::$app->view->registerLinkTag([
                    'rel' => 'icon',
                    'type' => 'image/png',
                    'href' => \yii\helpers\Url::to(['/favicon.ico'])
                ]);
            }
              
        ],
    ],
    'params' => $params,
];
