<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[WidgetTestimonial]].
 *
 * @see WidgetTestimonial
 */
class WidgetTestimonialQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WidgetTestimonial[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WidgetTestimonial|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
