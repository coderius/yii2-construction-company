<?php

namespace backend\models;

use Yii;
use common\models\user\User;
use backend\components\behaviors\blog\UploadFileBehavior;
use yii\imagine\Image;
use Imagine\Image\Point;
use Imagine\Image\Box;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "widget_carousel".
 *
 * @property int $id
 * @property string $header1
 * @property string $header2
 * @property string $buttonTitle
 * @property string $buttonLink
 * @property string $img
 * @property string $imgAlt
 */
class WidgetCarousel extends ActiveRecord
{
    public $file;
    
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
            [['header1', 'header2', 'buttonTitle', 'buttonLink', 'img', 'imgAlt'], 'required'],
            [['header1', 'header2', 'buttonTitle', 'buttonLink', 'img', 'imgAlt'], 'string', 'max' => 255],
            ['sortOrder', 'default', 'value' => 1],
            [['sortOrder', 'widgetId'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'header1' => Yii::t('app', 'Header1'),
            'header2' => Yii::t('app', 'Header2'),
            'buttonTitle' => Yii::t('app', 'Button Title'),
            'buttonLink' => Yii::t('app', 'Button Link'),
            'img' => Yii::t('app', 'Img'),
            'imgAlt' => Yii::t('app', 'Img Alt'),
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
                            return \Yii::getAlias('@widgetCarouselPicsPath/' . $attributes['id'] . '/big/');
                        },
                        'hendler' => function($fileTempName, $newFilePath){
                            Image::thumbnail($fileTempName, 1366, 800)
                            ->resize(new Box(1366, 800))
                            // ->copy()
                            // ->crop(new Point(0, 0), new Box(1366, 600))
                            ->save($newFilePath, ['quality' => 80]);
                            sleep(1);
                        }
                    ],
                ]
            ],
            // 'attribute' => [
            //     'class' => AttributesBehavior::class,
            //     'attributes' => [
            //         // 'widgetId' => [
            //         //     ActiveRecord::EVENT_BEFORE_INSERT  => [$this, 'makeTagsRelation'],
            //         // ],
                    
                    
            //     ],
            // ],

        ];
    }

    /**
     * Gets query for [[Widget]].
     *
     * @return \yii\db\ActiveQuery|WidgetCarouselQuery
     */
    public function getWidget()
    {
        return $this->hasOne(WidgetCarousel::class, ['id' => 'widgetId']);
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
     * @return WidgetCarouselQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetCarouselQuery(get_called_class());
    }
}
