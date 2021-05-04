<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "widget_socialgallery".
 *
 * @property int $id
 * @property int $widgetId
 * @property int $sortOrder
 * @property string $img
 * @property string $header1
 * @property string $header2
 * @property string|null $twitter
 * @property string|null $facebook
 * @property string|null $linkedin
 * @property string|null $instagram
 *
 * @property Widgets $widget
 */
class WidgetSocialgallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_socialgallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['widgetId', 'img', 'header1', 'header2'], 'required'],
            [['widgetId', 'sortOrder'], 'integer'],
            [['img', 'header1', 'header2', 'twitter', 'facebook', 'linkedin', 'instagram'], 'string', 'max' => 255],
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
            'twitter' => Yii::t('app', 'Twitter'),
            'facebook' => Yii::t('app', 'Facebook'),
            'linkedin' => Yii::t('app', 'Linkedin'),
            'instagram' => Yii::t('app', 'Instagram'),
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
     * @return WidgetSocialgalleryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetSocialgalleryQuery(get_called_class());
    }
}
