<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "price_category".
 *
 * @property int $id
 * @property string $alias
 * @property string $header
 * @property string|null $description
 * @property string|null $icon
 * @property int $status
 * @property int $sortOrder
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int|null $updatedBy
 *
 * @property Price[] $prices
 * @property User $createdBy0
 * @property User $updatedBy0
 * @property Price $id0
 */
class PriceCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'header', 'createdAt', 'createdBy'], 'required'],
            [['description'], 'string'],
            [['status', 'sortOrder', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'header', 'icon'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Price::className(), 'targetAttribute' => ['id' => 'categoryId']],
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
            'header' => Yii::t('app', 'Header'),
            'description' => Yii::t('app', 'Description'),
            'icon' => Yii::t('app', 'Icon'),
            'status' => Yii::t('app', 'Status'),
            'sortOrder' => Yii::t('app', 'Sort Order'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Prices]].
     *
     * @return \yii\db\ActiveQuery|PriceQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['categoryId' => 'id']);
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
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery|PriceQuery
     */
    public function getId0()
    {
        return $this->hasOne(Price::className(), ['categoryId' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PriceCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PriceCategoryQuery(get_called_class());
    }
}
