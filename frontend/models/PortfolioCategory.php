<?php

namespace frontend\models;

use Yii;
use common\models\user\User;

/**
 * This is the model class for table "portfolio_category".
 *
 * @property int $id
 * @property int|null $frontId portfolio item like front image
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
 * @property User $createdBy0
 * @property User $updatedBy0
 * @property Portfolio $front
 * @property PortfolioCategoryTag[] $portfolioCategoryTags
 * @property Tag[] $tags
 */
class PortfolioCategory extends \yii\db\ActiveRecord
{
    const ACTIVE_STATUS = 1;
    const DISABLED_STATUS = 0;
    
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
            [['frontId', 'sortOrder', 'status', 'viewCount', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'metaTitle', 'metaDesc', 'headerShort', 'headerLong', 'status', 'viewCount', 'createdAt', 'createdBy'], 'required'],
            [['alias', 'metaTitle', 'metaDesc', 'headerShort', 'headerLong'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
            [['frontId'], 'exist', 'skipOnError' => true, 'targetClass' => Portfolio::className(), 'targetAttribute' => ['frontId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'frontId' => Yii::t('app', 'Front ID'),
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
     * Gets query for [[Front]].
     *
     * @return \yii\db\ActiveQuery|PortfolioQuery
     */
    public function getFront()
    {
        return $this->hasOne(Portfolio::className(), ['id' => 'frontId']);
    }

    /**
     * Gets query for [[PortfolioCategoryTags]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getPortfolioCategoryTags()
    {
        return $this->hasMany(PortfolioCategoryTag::className(), ['portfolioCategoryId' => 'id']);
    }

    public function getPortfolio()
    {
        return $this->hasMany(Portfolio::className(), ['categoryId' => 'id']);
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

    public function hasFront()
    {
        return (bool) $this->frontId;
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
