<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "widgets".
 *
 * @property int $id
 * @property string $type
 * @property string $descriptions
 * @property string $header
 */
class Widgets extends \yii\db\ActiveRecord
{
    /**
     * Names equals to table name
     */
    const TYPE_CAROUSEL = "widget_carousel";
    const TYPE_FEATURE = "widget_feature";
    const TYPE_FACT = "widget_fact";
    const TYPE_GALLERY = "widget_gallery";
    const TYPE_VIDEO = "widget_video";
    const TYPE_SOCIALGALLERY = "widget_socialgallery";
    const TYPE_FAQ = "widget_faq";
    const TYPE_TESTIMONIAL = "widget_testimonial";
    const TYPE_BLOGLIST = "widget_bloglist";

    public static function widgetTypes(){
        return [
            self::TYPE_CAROUSEL => 'widget carousel',
            self::TYPE_FEATURE  => 'widget feature',
            self::TYPE_FACT  => 'widget fact',
            self::TYPE_GALLERY => 'widget_gallery',
            self::TYPE_VIDEO  => 'widget_video',
            self::TYPE_SOCIALGALLERY  => 'widget_socialgallery',
            self::TYPE_FAQ => 'widget_faq',
            self::TYPE_TESTIMONIAL  => 'widget_testimonial',
            self::TYPE_BLOGLIST  => 'widget_bloglist',
        ];
    }

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
            [['type', 'descriptions', 'header'], 'required'],
            [['type', 'header'], 'string'],
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
            'header' => Yii::t('app', 'Header'),
        ];
    }

    /**
     * Gets query for [[WidgetCarousels]].
     *
     * @return \yii\db\ActiveQuery|WidgetCarouselQuery
     */
    public function getWidgetCarousels()
    {
        return $this->hasMany(WidgetCarousel::class, ['widgetId' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return WidgetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetsQuery(get_called_class());
    }
}
