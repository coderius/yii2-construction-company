<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Widgets]].
 *
 * @see Widgets
 */
class WidgetsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Widgets[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Widgets|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
