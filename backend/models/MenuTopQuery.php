<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[MenuTop]].
 *
 * @see MenuTop
 */
class MenuTopQuery extends \yii\db\ActiveQuery
{
    public function orderSortOrder()
    {
        return $this->orderBy('sortOrder');
    }

    /**
     * {@inheritdoc}
     * @return MenuTop[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MenuTop|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
