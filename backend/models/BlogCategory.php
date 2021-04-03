<?php

namespace backend\models;

use Yii;
use common\models\user\User;

/**
 * This is the model class for table "blog_category".
 *
 * @property int $id
 * @property string $alias
 * @property string $metaTitle
 * @property string $metaDesc
 * @property string $header
 * @property string|null $text
 * @property int $sortOrder
 * @property int $status 0-desibled, 1- enabled
 * @property int $viewCount
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property BlogArticleBlogCategory[] $blogArticleBlogCategories
 * @property BlogArticle[] $articles
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'metaTitle', 'metaDesc', 'header', 'sortOrder', 'status', 'createdAt', 'createdBy', 'updatedBy'], 'required'],
            [['text'], 'string'],
            [['sortOrder', 'status', 'viewCount', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'metaTitle', 'metaDesc', 'header'], 'string', 'max' => 255],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
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
            'header' => Yii::t('app', 'Header'),
            'text' => Yii::t('app', 'Text'),
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
     * Gets query for [[BlogArticleBlogCategories]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleBlogCategoryQuery
     */
    public function getBlogArticleBlogCategories()
    {
        return $this->hasMany(BlogArticleBlogCategory::className(), ['categoryId' => 'id']);
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleQuery
     */
    public function getArticles()
    {
        return $this->hasMany(BlogArticle::className(), ['id' => 'articleId'])->viaTable('blog_article_blog_category', ['categoryId' => 'id']);
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
     * @return BlogCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogCategoryQuery(get_called_class());
    }
}
