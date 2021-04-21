<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[PriceCategory]].
 *
 * @see PriceCategory
 */
class PriceCategoryQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return PriceCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PriceCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
