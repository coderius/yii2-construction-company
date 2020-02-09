<?php

/**
 * @package myblog
 * @file SetUp.php created 09.02.2018 17:03:33
 * 
 * @copyright Copyright (C) 2018 Sergio Codev <codev>
 * @license This program is free software: GNU General Public License
 */

namespace frontend\bootstrap;

use yii;
use yii\base\BootstrapInterface;
use yii\base\ErrorHandler;
use yii\di\Container;

/**
 * Description of SetUp
 *
 * @author Sergio Codev <codev>
 */
class SetUp implements BootstrapInterface{
    
    public function bootstrap($app){
        
        $container = \Yii::$container;
        
        // $container->set('frontend\services\blog\BlogService');
        // $container->set('frontend\services\components\SideBarService');
        // $container->set('frontend\repositories\blog\BlogRepositoryInterface', 'frontend\repositories\blog\QueryBlogRepository');
//        $container->set('frontend\repositories\blog\BlogRepositoryInterface', 'frontend\repositories\blog\QueryBlogRepository');
    }
    
}
