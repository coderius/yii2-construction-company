<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[WidgetCarousel]].
 *
 * @see WidgetCarousel
 */
class WidgetCarouselQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WidgetCarousel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WidgetCarousel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
