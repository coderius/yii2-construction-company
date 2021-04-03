<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[BlogCategory]].
 *
 * @see BlogCategory
 */
class BlogCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BlogCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BlogCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
