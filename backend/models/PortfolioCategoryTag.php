<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "portfolio_category_tag".
 *
 * @property int $id
 * @property int $portfolioCategoryId
 * @property int $tagId
 *
 * @property PortfolioCategory $portfolioCategory
 * @property Tag $tag
 */
class PortfolioCategoryTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portfolio_category_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['portfolioCategoryId', 'tagId'], 'required'],
            [['portfolioCategoryId', 'tagId'], 'integer'],
            [['portfolioCategoryId', 'tagId'], 'unique', 'targetAttribute' => ['portfolioCategoryId', 'tagId']],
            [['portfolioCategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => PortfolioCategory::className(), 'targetAttribute' => ['portfolioCategoryId' => 'id']],
            [['tagId'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tagId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'portfolioCategoryId' => Yii::t('app', 'Portfolio Category ID'),
            'tagId' => Yii::t('app', 'Tag ID'),
        ];
    }

    /**
     * Gets query for [[PortfolioCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioCategory()
    {
        return $this->hasOne(PortfolioCategory::className(), ['id' => 'portfolioCategoryId']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tagId']);
    }
}
