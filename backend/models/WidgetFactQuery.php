<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[WidgetFact]].
 *
 * @see WidgetFact
 */
class WidgetFactQuery extends \yii\db\ActiveQuery
{
    public function orderSortOrder()
    {
        return $this->orderBy('sortOrder');
    }

    /**
     * {@inheritdoc}
     * @return WidgetFact[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WidgetFact|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
