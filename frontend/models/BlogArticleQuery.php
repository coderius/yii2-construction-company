<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[BlogArticle]].
 *
 * @see BlogArticle
 */
class BlogArticleQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    public function desibled()
    {
        return $this->andWhere('[[status]]=0');
    }

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
