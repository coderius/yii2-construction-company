<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[WidgetFeature]].
 *
 * @see WidgetFeature
 */
class WidgetFeatureQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WidgetFeature[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WidgetFeature|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
