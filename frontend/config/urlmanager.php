<?php
return [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [

                '/' => 'index/index',
                '<action:(login|logout|signup|auth)>' => 'site/<action>',
                'site/<action>' => 'site/<action>',
                'sitemap.xml' => 'sitemap/index',
                'rss.xml' => 'rss/index',

                
            ],
        ];
?>
