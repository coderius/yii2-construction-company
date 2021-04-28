<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[WidgetGallery]].
 *
 * @see WidgetGallery
 */
class WidgetGalleryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WidgetGallery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WidgetGallery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
