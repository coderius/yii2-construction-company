<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property int|null $categoryId
 * @property string $name
 * @property int $cost цена за еденицу
 * @property string $unit единица измерения
 * @property string|null $equal от или до или null если ничего
 * @property int $sortOrder очередь
 * @property int $status
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int|null $updatedBy
 *
 * @property User $createdBy0
 * @property User $updatedBy0
 * @property PriceCategory $category
 * @property PriceCategory $priceCategory
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoryId', 'cost', 'sortOrder', 'status', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['name', 'cost', 'unit', 'createdAt', 'createdBy'], 'required'],
            [['name', 'unit', 'equal'], 'string', 'max' => 255],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => PriceCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
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
            'name' => Yii::t('app', 'Name'),
            'cost' => Yii::t('app', 'Cost'),
            'unit' => Yii::t('app', 'Unit'),
            'equal' => Yii::t('app', 'Equal'),
            'sortOrder' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
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
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|PriceCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PriceCategory::className(), ['id' => 'categoryId']);
    }

    /**
     * Gets query for [[PriceCategory]].
     *
     * @return \yii\db\ActiveQuery|PriceCategoryQuery
     */
    public function getPriceCategory()
    {
        return $this->hasOne(PriceCategory::className(), ['id' => 'categoryId']);
    }

    /**
     * {@inheritdoc}
     * @return PriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PriceQuery(get_called_class());
    }
}
