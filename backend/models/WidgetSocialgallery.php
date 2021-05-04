<?php

namespace backend\models;

use Yii;
use yii\behaviors\AttributesBehavior;
use backend\components\behaviors\blog\UploadFileBehavior;
use yii\imagine\Image;
use Imagine\Image\Point;
use Imagine\Image\Box;


/**
 * This is the model class for table "widget_socialgallery".
 *
 * @property int $id
 * @property int $widgetId
 * @property int $sortOrder
 * @property int $img
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
    public $file;
    
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
            [['widgetId', 'header1', 'header2'], 'required'],
            [['widgetId', 'sortOrder'], 'integer'],
            [['header1', 'header2', 'twitter', 'facebook', 'linkedin', 'instagram'], 'string', 'max' => 255],
            [['widgetId'], 'exist', 'skipOnError' => true, 'targetClass' => Widgets::class, 'targetAttribute' => ['widgetId' => 'id']],
            [['sortOrder'], 'default', 'value' => 1],
            [['img'], 'safe']
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

    public function behaviors()
    {
        return [
            'uploadFileBehavior' => [
                'class' => UploadFileBehavior::class,
                'nameOfAttributeStorage' => 'img',
                'directories' => [
                    [
                        'path' => function($attributes){
                            return \Yii::getAlias('@widgetSocialGalleryPicsPath/' . $attributes['id'] . '/middle/');
                        },
                        'hendler' => function($fileTempName, $newFilePath){
                            Image::thumbnail($fileTempName, 400, 400)
                            ->save($newFilePath, ['quality' => 80]);
                            sleep(1);
                        }
                    ],

                    [
                        'path' => function($attributes){
                            return \Yii::getAlias('@widgetSocialGalleryPicsPath/' . $attributes['id'] . '/big/');
                        },
                        'hendler' => function($fileTempName, $newFilePath){
                            Image::thumbnail($fileTempName, 800, 800)
                            ->save($newFilePath, ['quality' => 80]);
                            sleep(1);
                        }
                    ],
                ]
            ],

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
