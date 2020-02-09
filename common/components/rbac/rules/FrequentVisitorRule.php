<?php
namespace common\components\rbac\rules;

use yii\rbac\Rule;
use yii\web\Cookie;
use Yii;

class FrequentVisitorRule extends Rule
{
    public $name = 'rule_frequent-visitor';
    const COOKIE_NAME = 'count_visit';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        // $cookies = Yii::$app->request->cookies;
        $cName = isset($params['counter_cookie_name']) ? $params['counter_cookie_name'] : self::COOKIE_NAME;
        //Если имя куки не передано, значит и не назначено в приложении. Или если имя
        //передано, но куки не установлены - сделаем это тут...
        $counter = Yii::$app->request->cookies->getValue($cName, 0);
        $counter += 1;
        Yii::$app->response->cookies->remove($cName);
        Yii::$app->response->cookies->add(new Cookie([
            'name' => $cName,
            'value' => $counter,//eny
            'expire' => time() + 86400 * 365,
        ]));

        if (Yii::$app->request->cookies->has($cName)){
            return $counter == 5 ? true : false;
        }else{
            return false;
        }
    }
}