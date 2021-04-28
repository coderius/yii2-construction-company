<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "widget_gallery".
 *
 * @property int $id
 * @property int $widgetId
 * @property int $sortOrder
 * @property string $header
 * @property string $text
 * @property string $img
 *
 * @property Widgets $widget
 */
class WidgetGallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['widgetId', 'header', 'text', 'img'], 'required'],
            [['widgetId', 'sortOrder'], 'integer'],
            [['header'], 'string', 'max' => 150],
            [['text', 'img'], 'string', 'max' => 255],
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
            'header' => Yii::t('app', 'Header'),
            'text' => Yii::t('app', 'Text'),
            'img' => Yii::t('app', 'Img'),
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
     * @return WidgetGalleryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetGalleryQuery(get_called_class());
    }
}
