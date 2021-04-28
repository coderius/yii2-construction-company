<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[WidgetBloglist]].
 *
 * @see WidgetBloglist
 */
class WidgetBloglistQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WidgetBloglist[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WidgetBloglist|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
