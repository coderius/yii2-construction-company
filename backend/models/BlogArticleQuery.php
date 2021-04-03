<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[BlogArticle]].
 *
 * @see BlogArticle
 */
class BlogArticleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BlogArticle[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BlogArticle|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
