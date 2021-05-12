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
 * This is the model class for table "portfolio_category".
 *
 * @property int $id
 * @property string $alias
 * @property string $metaTitle
 * @property string $metaDesc
 * @property string $headerShort
 * @property string $headerLong
 * @property int $sortOrder
 * @property int $status 0-desibled, 1- enabled
 * @property int $viewCount view all category
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int|null $updatedBy
 *
 * @property Portfolio[] $portfolios
 * @property User $createdBy0
 * @property User $updatedBy0
 * @property PortfolioCategoryTag[] $portfolioCategoryTags
 * @property Tag[] $tags
 */
class PortfolioCategory extends \yii\db\ActiveRecord
{
    public $selectedTags = [];
    
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
        return 'portfolio_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'metaTitle', 'metaDesc', 'headerShort', 'headerLong', 'status'], 'required'],
            [['sortOrder', 'status', 'viewCount', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'metaTitle', 'metaDesc', 'headerShort', 'headerLong'], 'string', 'max' => 255],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
            [['alias'], 'unique'],
            [['createdAt', 'updatedAt', 'createdBy', 'updatedBy', 'viewCount', 'selectedTags', 'frontId'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'metaTitle' => Yii::t('app', 'Meta Title'),
            'metaDesc' => Yii::t('app', 'Meta Desc'),
            'headerShort' => Yii::t('app', 'Header Short'),
            'headerLong' => Yii::t('app', 'Header Long'),
            'sortOrder' => Yii::t('app', 'Sort Order'),
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
                    'selectedTags' => [
                        ActiveRecord::EVENT_AFTER_INSERT  => [$this, 'makeTagsRelation'],
                        ActiveRecord::EVENT_AFTER_UPDATE  => [$this, 'makeTagsRelation'] 
                    ],
                    
                ],
            ],
            
        ];
    }

    public function makeTagsRelation($event, $attribute)
    {
        // var_dump($this->$attribute);die;
        if(!empty($this->$attribute)){
            PortfolioCategoryTag::deleteAll(['portfolioCategoryId' => $this->id]);
            
            foreach($this->$attribute as $selected){
                $relation = new PortfolioCategoryTag();
                $relation->portfolioCategoryId = $this->id;
                $relation->tagId = $selected;
                $relation->save();
            }
        }
    }

    public function initSelectedVirtualAttributes()
    {
        $this->selectedTags = ArrayHelper::getColumn($this->getTags()->asArray()->all(), 'id');
        Yii::info('Selected Virtual Attributes is loaded.', __METHOD__);
    }

    /**
     * Gets query for [[Front]].
     *
     * @return \yii\db\ActiveQuery|PortfolioQuery
     */
    public function getFront()
    {
        return $this->hasOne(Portfolio::className(), ['id' => 'frontId']);
    }

    /**
     * Gets query for [[Portfolios]].
     *
     * @return \yii\db\ActiveQuery|PortfolioQuery
     */
    public function getPortfolios()
    {
        return $this->hasMany(Portfolio::className(), ['categoryId' => 'id']);
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
     * Gets query for [[PortfolioCategoryTags]].
     *
     * @return \yii\db\ActiveQuery|PortfolioCategoryTagQuery
     */
    public function getPortfolioCategoryTags()
    {
        return $this->hasMany(PortfolioCategoryTag::className(), ['portfolioCategoryId' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery|TagQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tagId'])->viaTable('portfolio_category_tag', ['portfolioCategoryId' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PortfolioCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PortfolioCategoryQuery(get_called_class());
    }
}
