<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[WidgetVideo]].
 *
 * @see WidgetVideo
 */
class WidgetVideoQuery extends \yii\db\ActiveQuery
{
    public function orderSortOrder()
    {
        return $this->orderBy('sortOrder');
    }

    /**
     * {@inheritdoc}
     * @return WidgetVideo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WidgetVideo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
