<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "widgets".
 *
 * @property int $id
 * @property string $type
 * @property string $descriptions
 *
 * @property WidgetCarousel[] $widgetCarousels
 */
class Widgets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widgets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'descriptions'], 'required'],
            [['type'], 'string'],
            [['descriptions'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'descriptions' => Yii::t('app', 'Descriptions'),
        ];
    }

    /**
     * Gets query for [[WidgetCarousels]].
     *
     * @return \yii\db\ActiveQuery|WidgetCarouselQuery
     */
    public function getWidgetCarousels()
    {
        return $this->hasMany(WidgetCarousel::className(), ['widgetId' => 'id']);
    }

    //-----------
    //Has methods
    //-----------

    public function countWidgetCarousels()
    {
        return $this->getWidgetCarousels()->count();
    }

    public function hasWidgetCarousels()
    {
        return (bool) $this->countWidgetCarousels();
    }

    //-----------
    //Has methods
    //-----------

    /**
     * {@inheritdoc}
     * @return WidgetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetsQuery(get_called_class());
    }
}
