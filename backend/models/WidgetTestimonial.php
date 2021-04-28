<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "widget_testimonial".
 *
 * @property int $id
 * @property int $widgetId
 * @property int $sortOrder
 * @property string $img
 * @property string $header1
 * @property string $header2
 * @property string $text
 *
 * @property Widgets $widget
 */
class WidgetTestimonial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_testimonial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['widgetId', 'img', 'header1', 'header2', 'text'], 'required'],
            [['widgetId', 'sortOrder'], 'integer'],
            [['text'], 'string'],
            [['img', 'header1', 'header2'], 'string', 'max' => 255],
            [['widgetId'], 'exist', 'skipOnError' => true, 'targetClass' => Widgets::className(), 'targetAttribute' => ['widgetId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'widgetId' => Yii::t('app', 'Widget ID'),
            'sortOrder' => Yii::t('app', 'Sort Order'),
            'img' => Yii::t('app', 'Img'),
            'header1' => Yii::t('app', 'Header1'),
            'header2' => Yii::t('app', 'Header2'),
            'text' => Yii::t('app', 'Text'),
        ];
    }

    /**
     * Gets query for [[Widget]].
     *
     * @return \yii\db\ActiveQuery|WidgetsQuery
     */
    public function getWidget()
    {
        return $this->hasOne(Widgets::className(), ['id' => 'widgetId']);
    }

    /**
     * {@inheritdoc}
     * @return WidgetTestimonialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetTestimonialQuery(get_called_class());
    }
}
