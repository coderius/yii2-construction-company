<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PageWidgets]].
 *
 * @see PageWidgets
 */
class PageWidgetsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PageWidgets[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PageWidgets|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
