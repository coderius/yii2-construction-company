<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "widget_carousel".
 *
 * @property int $id
 * @property int $sortOrder
 * @property string $header1
 * @property string $header2
 * @property string $buttonTitle
 * @property string $buttonLink
 * @property string $img
 * @property string $imgAlt
 */
class WidgetCarousel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_carousel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sortOrder'], 'integer'],
            [['header1', 'header2', 'buttonTitle', 'buttonLink', 'img', 'imgAlt'], 'required'],
            [['header1', 'header2', 'buttonTitle', 'buttonLink', 'img', 'imgAlt'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sortOrder' => Yii::t('app', 'Sort Order'),
            'header1' => Yii::t('app', 'Header1'),
            'header2' => Yii::t('app', 'Header2'),
            'buttonTitle' => Yii::t('app', 'Button Title'),
            'buttonLink' => Yii::t('app', 'Button Link'),
            'img' => Yii::t('app', 'Img'),
            'imgAlt' => Yii::t('app', 'Img Alt'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return WidgetCarouselQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetCarouselQuery(get_called_class());
    }
}
