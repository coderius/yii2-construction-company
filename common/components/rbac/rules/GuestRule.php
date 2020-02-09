<?php
namespace common\components\rbac\rules;

use yii\rbac\Rule;
use yii\web\Cookie;
use Yii;

class GuestRule extends Rule
{
    public $name = 'rule_detect-guest';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return Yii::$app->user->getIsGuest();
    }
}