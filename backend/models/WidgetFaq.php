<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "widget_faq".
 *
 * @property int $id
 * @property int $widgetId
 * @property int $sortOrder
 * @property string $header
 * @property string $text
 *
 * @property Widgets $widget
 */
class WidgetFaq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_faq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['widgetId', 'header', 'text'], 'required'],
            [['widgetId', 'sortOrder'], 'integer'],
            [['text'], 'string'],
            [['header'], 'string', 'max' => 255],
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
     * @return WidgetFaqQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetFaqQuery(get_called_class());
    }
}
