<?php

namespace backend\models;

use Yii;
use common\models\user\User;
use backend\components\behaviors\blog\UploadFileBehavior;
use yii\imagine\Image;
use Imagine\Image\Point;
use Imagine\Image\Box;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributesBehavior;

/**
 * This is the model class for table "widget_carousel".
 *
 * @property int $id
 * @property int $widgetId
 * @property string $header1
 * @property string $header2
 * @property string $buttonTitle
 * @property string $buttonLink
 * @property string $img
 * @property string $imgAlt
 */
class WidgetCarousel extends ActiveRecord
{
    public $selectedWidget;
    public $file;
    
    public function init(){
        $this->on(self::EVENT_AFTER_FIND, [$this, 'initSelectedVirtualAttributes']);
      
        parent::init();
    }

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
            [['header1', 'header2', 'buttonTitle', 'buttonLink', 'img', 'imgAlt', 'selectedWidget'], 'required'],
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
            'attribute' => [
                'class' => AttributesBehavior::class,
                'attributes' => [
                    'widgetId' => [
                        ActiveRecord::EVENT_BEFORE_INSERT  => [$this, 'makeWidgetId'],
                        ActiveRecord::EVENT_BEFORE_UPDATE  => [$this, 'makeWidgetId']
                    ],
                ],
            ],

        ];
    }

    public function makeWidgetId()
    {
        return $this->selectedWidget;
    }

    /**
     * For populate input form in update mode
     *
     * @return void
     */
    public function initSelectedVirtualAttributes()
    {
        $this->selectedWidget = ArrayHelper::getColumn($this->getWidget()->asArray()->all(), 'id');
        Yii::info('Selected Virtual Attributes is loaded.', __METHOD__);
    }

    /**
     * Gets query for [[Widget]].
     *
     * @return \yii\db\ActiveQuery|WidgetCarouselQuery
     */
    public function getWidget()
    {
        return $this->hasOne(Widgets::class, ['id' => 'widgetId']);
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
