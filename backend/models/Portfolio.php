<?php

namespace backend\models;

use Yii;
use common\models\user\User;
use yii\behaviors\AttributesBehavior;
use backend\components\behaviors\blog\UploadFileBehavior;
use yii\imagine\Image;
use Imagine\Image\Point;
use Imagine\Image\Box;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "portfolio".
 *
 * @property int $id
 * @property int $categoryId
 * @property int $isFront
 * @property string $header
 * @property string $description
 * @property string $img
 * @property string $imgAlt
 * @property int $status 0-desible, 1- enable
 * @property int $viewCount
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int|null $updatedBy
 *
 * @property PortfolioCategory $category
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class Portfolio extends \yii\db\ActiveRecord
{
    public $selectedCategories = [];//virtual var use in form create or update
    
    public $file;//загружаемое изображение
    
    const ACTIVE_STATUS = 1;
    const DISABLED_STATUS = 0;
    
    public static $statusesName = [
        self::ACTIVE_STATUS => 'Активен',
        self::DISABLED_STATUS => 'Отключен',
    ];
    
    public function init(){

        // $this->on(self::EVENT_AFTER_LOAD, [$this, 'afterLoad']);
        $this->on(self::EVENT_AFTER_FIND, [$this, 'initSelectedVirtualAttributes']);
      
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portfolio';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['header', 'description', 'selectedCategories'];//Scenario Values Only Accepted
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['header', 'description', 'file', 'selectedCategories'], 'required'],
            [['categoryId', 'status', 'viewCount', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['description', 'img'], 'string'],
            [['header', 'imgAlt'], 'string', 'max' => 255],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => PortfolioCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
            [['createdAt', 'updatedAt', 'createdBy', 'updatedBy', 'viewCount', 'selectedCategories', 'categoryId'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'categoryId' => Yii::t('app', 'Category ID'),
            'header' => Yii::t('app', 'Header'),
            'description' => Yii::t('app', 'Description'),
            'img' => Yii::t('app', 'Img'),
            'imgAlt' => Yii::t('app', 'Img Alt'),
            'status' => Yii::t('app', 'Status'),
            'viewCount' => Yii::t('app', 'View Count'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['createdAt'],
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],

                ],
                'value' => function(){
                    return time();
                },
            //'value' => new \yii\db\Expression('NOW()'),

            ],
            
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => 'updatedBy',
            ],
            
            'attribute' => [
                'class' => AttributesBehavior::class,
                'attributes' => [
                    'viewCount' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => 0,//$this->owner->$attribute
                    ],
                    
                    'selectedCategories' => [
                        ActiveRecord::EVENT_BEFORE_INSERT  => [$this, 'makeCategoriesRelation'],
                        ActiveRecord::EVENT_BEFORE_UPDATE  => [$this, 'makeCategoriesRelation'] 
                    ],
                    
                ],
            ],
            'uploadFileBehavior' => [
                'class' => UploadFileBehavior::class,
                'nameOfAttributeStorage' => 'img',
                'directories' => [
                    [
                        'path' => function($attributes){
                            return \Yii::getAlias('@portfolioPicsPath/' . $attributes['id'] . '/big/');
                        },
                        'hendler' => function($fileTempName, $newFilePath){
                            Image::thumbnail($fileTempName, 900, 900*2/3)
                            ->copy()
                            ->crop(new Point(0, 0), new Box(900, 900*2/3))
                            ->save($newFilePath, ['quality' => 80]);
                            sleep(1);
                        }
                    ],
                    [
                        'path' => function($attributes){
                            return \Yii::getAlias('@portfolioPicsPath/' . $attributes['id'] . '/middle/');
                        },
                        'hendler' => function($fileTempName, $newFilePath){
                            Image::thumbnail($fileTempName, 400, 400*2/3)
                            ->save($newFilePath, ['quality' => 80]);
                            sleep(1);
                        }
                    ],
                    [
                        'path' => function($attributes){
                            return \Yii::getAlias('@portfolioPicsPath/' . $attributes['id'] . '/small/');
                        },
                        'hendler' => function($fileTempName, $newFilePath){
                            Image::thumbnail($fileTempName, 150, 150*2/3)
                            ->save($newFilePath, ['quality' => 80]);
                            sleep(1);
                        }
                    ],
                ]
            ],

        ];
    }

    public function initSelectedVirtualAttributes()
    {
        $this->selectedCategories = ArrayHelper::getColumn($this->getCategory()->asArray()->all(), 'id');
        Yii::info('Selected Virtual Attributes is loaded.', __METHOD__);
    }

    public function makeCategoriesRelation($event, $attribute)
    {
        // var_dump($this->$attribute);die;
        if(!empty($this->$attribute)){
            $this->categoryId = $this->$attribute;
        }
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|PortfolioCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PortfolioCategory::className(), ['id' => 'categoryId']);
    }

    /**
     * Gets query for [[CreatedBy0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }

    /**
     * Gets query for [[UpdatedBy0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'updatedBy']);
    }

    /**
     * {@inheritdoc}
     * @return PortfolioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PortfolioQuery(get_called_class());
    }
}
