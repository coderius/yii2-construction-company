<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[WidgetCarousel]].
 *
 * @see WidgetCarousel
 */
class WidgetCarouselQuery extends \yii\db\ActiveQuery
{
    public function orderSortOrder()
    {
        return $this->orderBy('sortOrder');
    }

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
