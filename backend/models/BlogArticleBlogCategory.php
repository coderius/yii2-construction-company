<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "blog_article_blog_category".
 *
 * @property int $id
 * @property int $articleId
 * @property int $categoryId
 *
 * @property BlogArticle $article
 * @property BlogCategory $category
 */
class BlogArticleBlogCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_article_blog_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articleId', 'categoryId'], 'required'],
            [['articleId', 'categoryId'], 'integer'],
            [['articleId', 'categoryId'], 'unique', 'targetAttribute' => ['articleId', 'categoryId']],
            [['articleId'], 'exist', 'skipOnError' => true, 'targetClass' => BlogArticle::className(), 'targetAttribute' => ['articleId' => 'id']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'articleId' => Yii::t('app', 'Article ID'),
            'categoryId' => Yii::t('app', 'Category ID'),
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(BlogArticle::className(), ['id' => 'articleId']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'categoryId']);
    }
}
