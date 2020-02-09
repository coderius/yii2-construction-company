<?php


return [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => $baseUrl.'/backend/web',//and in 'request => baseUrl' to
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
//            'suffix' => '/',
            'rules' => [
                
//                '/' => 'admin/index',
                'admin/index' => 'admin/index',
                'logout' => 'base-admin/logout',
                
                '<controller>/<action>' => '<controller>/<action>',
                '<controller>/<action><id:\d+>' => '<controller>/<action>',
            ],
        ];
?>
