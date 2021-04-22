<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PageHome]].
 *
 * @see PageHome
 */
class PageHomeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PageHome[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PageHome|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
