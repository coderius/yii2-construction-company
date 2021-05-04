<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "widget_video".
 *
 * @property int $id
 * @property int $widgetId
 * @property int $sortOrder
 * @property string $video url to video. For example https://www.youtube.com/embed/DWRcNpR6Kdc
 *
 * @property Widgets $widget
 */
class WidgetVideo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['widgetId', 'video'], 'required'],
            [['widgetId', 'sortOrder'], 'integer'],
            [['video'], 'string', 'max' => 255],
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
            'video' => Yii::t('app', 'Video'),
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
     * @return WidgetVideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetVideoQuery(get_called_class());
    }
}
