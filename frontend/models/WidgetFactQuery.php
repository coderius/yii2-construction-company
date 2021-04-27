<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[WidgetFact]].
 *
 * @see WidgetFact
 */
class WidgetFactQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
