<?php

namespace common\models\user;

/**
 * This is the ActiveQuery class for [[BlogArticles]].
 *
 * @see BlogArticles
 */
class UserQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['flagActive' => BlogArticles::ACTIVE_STATUS]);
    }
    
    public function username()
    {
        return $this->one()->username;
    }
    /**
     * @inheritdoc
     * @return BlogArticles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BlogArticles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

