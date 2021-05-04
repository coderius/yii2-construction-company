<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[WidgetVideo]].
 *
 * @see WidgetVideo
 */
class WidgetVideoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
