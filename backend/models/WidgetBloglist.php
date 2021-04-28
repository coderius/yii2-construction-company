<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "widget_bloglist".
 *
 * @property int $id
 * @property int $widgetId
 * @property string $typeContent How to render widget from blog table
 *
 * @property Widgets $widget
 */
class WidgetBloglist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_bloglist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['widgetId', 'typeContent'], 'required'],
            [['widgetId'], 'integer'],
            [['typeContent'], 'string'],
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
            'typeContent' => Yii::t('app', 'Type Content'),
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
     * @return WidgetBloglistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetBloglistQuery(get_called_class());
    }
}
