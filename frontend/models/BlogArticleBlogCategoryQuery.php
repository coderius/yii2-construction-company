<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[BlogArticleBlogCategory]].
 *
 * @see BlogArticleBlogCategory
 */
class BlogArticleBlogCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BlogArticleBlogCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BlogArticleBlogCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
