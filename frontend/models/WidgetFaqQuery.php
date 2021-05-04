<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[WidgetFaq]].
 *
 * @see WidgetFaq
 */
class WidgetFaqQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WidgetFaq[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WidgetFaq|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
