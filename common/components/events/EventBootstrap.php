<?php

/**
 * @package myblog
 * @file EventBootstrap.php created 06.06.2018 20:06:02
 * 
 * @copyright Copyright (C) 2018 Sergio coderius <coderius>
 * @license This program is free software: GNU General Public License
 */
namespace common\components\events;

use yii;
use yii\base\BootstrapInterface;
use yii\base\ErrorHandler;
use yii\di\Container;
use backend\models\blog\BlogArticles;
use yii\db\ActiveRecord;
use yii\base\Event;
/**
 * Description of SetUp
 *
 * @author Sergio Codev <codev>
 */
class EventBootstrap implements BootstrapInterface{
    
    public function bootstrap($app){
        
        $container = \Yii::$container;
        
        $this->setSitemapEvents();
        
    }
    
    private function setSitemapEvents() {
        $events = [
            ActiveRecord::EVENT_AFTER_INSERT, 
            ActiveRecord::EVENT_AFTER_UPDATE,
            ActiveRecord::EVENT_AFTER_DELETE
        ];

        // foreach ($events as $eventName) {
        //     Event::on(BlogArticles::className(), $eventName, function ($event) {
        //         \Yii::$app->frontendCache->delete('sitemap');
        //     });
        // }
    }

}   
