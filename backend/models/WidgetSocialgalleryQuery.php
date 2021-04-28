<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[WidgetSocialgallery]].
 *
 * @see WidgetSocialgallery
 */
class WidgetSocialgalleryQuery extends \yii\db\ActiveQuery
{
    public function orderSortOrder()
    {
        return $this->orderBy('sortOrder');
    }

    /**
     * {@inheritdoc}
     * @return WidgetSocialgallery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WidgetSocialgallery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
