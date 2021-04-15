<?php
return [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [

                '/' => 'main/index',
                'page/<alias:[\w_-]+>' => 'main/page',

                'blog/<pageNum:\d+>' => 'blog/index',//пагинация блога
                'blog' => 'blog/index',
                
                
                'blog/category/<alias:[\w_-]+>/<pageNum:\d+>' => 'blog/category',
                'blog/category/<alias:[\w_-]+>' => 'blog/category',
                
                'blog/tag/<alias:[\w_-]+>/<pageNum:\d+>' => 'blog/tag',
                'blog/tag/<alias:[\w_-]+>' => 'blog/tag',
                
                'portfolios/<pageNum:\d+>' => 'portfolio/index',
                'portfolios' => 'portfolio/index',

                'portfolios/category/<alias:[\w_-]+>/<pageNum:\d+>' => 'portfolio/category',
                'portfolios/category/<alias:[\w_-]+>' => 'portfolio/category',

                'portfolios/tag/<alias:[\w_-]+>/<pageNum:\d+>' => 'portfolio/tag',
                'portfolios/tag/<alias:[\w_-]+>' => 'portfolio/tag',

                'price' => 'price/index',

                'blog/article/<alias:[\w_-]+>' => 'blog/article',

                '<action:(login|logout|signup|auth)>' => 'site/<action>',
                '<action>' => 'main/<action>',
                
                // 'site/<action>' => 'site/<action>',
                'sitemap.xml' => 'sitemap/index',
                'rss.xml' => 'rss/index',

                // '<controller>/<action>' => '<controller>/<action>',
                // '<controller>/<action><id:\d+>' => '<controller>/<action>',

            ],
        ];
?>
