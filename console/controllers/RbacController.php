<?php

/**
 * @package myblog
 * @file RbacController.php created 31.03.2018 15:57:18
 * 
 * @copyright Copyright (C) 2018 Sergio Codev <codev>
 * @license This program is free software: GNU General Public License
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\components\rbac\Rbac;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();//На всякий случай удаляем старые данные из БД...
        
        // добавляем разрешение "createPost"
        $useAdminPanel = $auth->createPermission(Rbac::PERMISSION_ADMIN_PANEL);
        $useAdminPanel->description = 'Use admin panel';
        $auth->add($useAdminPanel);

        // добавляем роль "author" и даём роли разрешение "createPost"
        $user = $auth->createRole(Rbac::ROLE_USER);
        $auth->add($user);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole(Rbac::ROLE_ADMIN);
        $auth->add($admin);
        $auth->addChild($admin, $useAdminPanel);
        $auth->addChild($admin, $user);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($admin, 1);
        
        $this->stdout('Done!' . PHP_EOL);
    }

    /**
     * Create role 'guest'
     * In console run yii rbac/create-default-role-guest
     *
     * @return void
     */
    public function actionCreateDefaultRoleGuest()
    {
        $auth = Yii::$app->authManager;
        
        $ruleGuestRule = new \common\components\rbac\rules\GuestRule;
        $auth->add($ruleGuestRule);
        
        $guest = $auth->createRole(Rbac::ROLE_GUEST);
        $guest->description = 'Роль для гостя';
        $guest->ruleName = $ruleGuestRule->name;
        $auth->add($guest);

        $this->stdout('Role: ' . Rbac::ROLE_GUEST . ' is Done!' . PHP_EOL);
    }

    /**
     * Create permission
     * In console run yii rbac/create-frequent-visitor-permission
     *
     * @return void
     */
    public function actionCreateFrequentVisitorPermission()
    {
        $auth = Yii::$app->authManager;

        //Cоздали правила
        $ruleFrequentVisitorRule = new \common\components\rbac\rules\FrequentVisitorRule;
        $auth->add($ruleFrequentVisitorRule);

        //Создали разрешение частого посетителя
        $permfrequentVisitor= $auth->createPermission(Rbac::PERM_FREQUENT_VISITOR);
        $permfrequentVisitor->description = 'Разрешение для частых посетителей';
        //Добавим правила в роль и разрешение
        $permfrequentVisitor->ruleName = $ruleFrequentVisitorRule->name;
        
        //Создадим разрешение в базе данных
        $auth->add($permfrequentVisitor);
        
        $this->stdout('Permission: frequent-visitor is created' . PHP_EOL);
    }

    /**
     * Add permission to role
     * In console run yii rbac/add-permission-to-role guest perm-frequent-visitor
     *
     * @param string $role
     * @param string $permission
     * @return void
     */
    public function actionAddPermissionToRole($role, $permission)
    {
        $auth = Yii::$app->authManager;

        $role = $auth->getRole($role);
        $perm = $auth->getPermission($permission);
        $auth->addChild($role, $perm);

        $this->stdout('Role: ' . $role . ' attached with ' .$perm. PHP_EOL);
    }
}