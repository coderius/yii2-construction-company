<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[WidgetSocialgallery]].
 *
 * @see WidgetSocialgallery
 */
class WidgetSocialgalleryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
