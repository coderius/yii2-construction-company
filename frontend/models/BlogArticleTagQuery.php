<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[BlogArticleTag]].
 *
 * @see BlogArticleTag
 */
class BlogArticleTagQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BlogArticleTag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BlogArticleTag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
