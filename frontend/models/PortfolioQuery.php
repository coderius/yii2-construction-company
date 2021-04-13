<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Portfolio]].
 *
 * @see Portfolio
 */
class PortfolioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Portfolio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Portfolio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
