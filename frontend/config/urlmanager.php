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
                'contacts' => 'main/contacts',

                'send-email' => 'main/send-email',

                'blog/<pageNum:\d+>' => 'blog/index',
                'blog' => 'blog/index',

                'blog/category/<alias:[\w_-]+>/<pageNum:\d+>' => 'blog/category',
                'blog/category/<alias:[\w_-]+>' => 'blog/category',
                
                'blog/tag/<alias:[\w_-]+>/<pageNum:\d+>' => 'blog/tag',
                'blog/tag/<alias:[\w_-]+>' => 'blog/tag',
                
                'portfolios/<pageNum:\d+>' => 'portfolio/index',
                'portfolios' => 'portfolio/index',
                'portfolios/pic-update-counter' => 'portfolio/pic-update-counter',
                
                'portfolios/category/<alias:[\w_-]+>/<pageNum:\d+>' => 'portfolio/category',
                'portfolios/category/<alias:[\w_-]+>' => 'portfolio/category',

                'portfolios/tag/<alias:[\w_-]+>/<pageNum:\d+>' => 'portfolio/tag',
                'portfolios/tag/<alias:[\w_-]+>' => 'portfolio/tag',

                'price' => 'price/index',

                'blog/article/<alias:[\w_-]+>' => 'blog/article',

                // search
                'search' => 'search/search',
                'search/<pageNum:\d+>' => 'search/search',
                'auto-complete' => 'search/auto-complete',
                // ./search

                '<action:(login|logout|signup|auth)>' => 'site/<action>',
                '<action>' => 'main/<action>',
                
                // 'site/<action>' => 'site/<action>',
                'sitemap.xml' => 'sitemap/index',
                'rss.xml' => 'rss/index',
                // 'auto-complete/<query:[\w_-]+>' => 'search/auto-complete',

                // '<controller>/<action>' => '<controller>/<action>',
                // '<controller>/<action><id:\d+>' => '<controller>/<action>',

            ],
        ];
?>
