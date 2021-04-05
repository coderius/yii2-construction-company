<?php

namespace backend\models;

use Yii;
use common\models\user\User;

/**
 * This is the model class for table "blog_article".
 *
 * @property int $id
 * @property string $alias
 * @property string $metaTitle
 * @property string $metaDesc
 * @property int $status 0-desible, 1- enable
 * @property string|null $header1
 * @property string $text
 * @property string|null $img decoded array(src,title,alt)
 * @property int $viewCount
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property User $createdBy0
 * @property User $updatedBy0
 * @property BlogArticleBlogCategory[] $blogArticleBlogCategories
 * @property BlogCategory[] $categories
 * @property BlogArticleTag[] $blogArticleTags
 * @property Tag[] $tags
 */
class BlogArticle extends \yii\db\ActiveRecord
{
    public $file;//загружаемое изображение

    const ACTIVE_STATUS = 1;
    const DISABLED_STATUS = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'metaTitle', 'metaDesc', 'status', 'text', 'createdAt', 'createdBy', 'updatedBy'], 'required'],
            [['status', 'viewCount', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['text', 'img'], 'string'],
            [['alias', 'metaTitle', 'metaDesc', 'header1'], 'string', 'max' => 255],
            [['alias'], 'unique'],
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
            'status' => Yii::t('app', 'Status'),
            'header1' => Yii::t('app', 'Header1'),
            'text' => Yii::t('app', 'Text'),
            'img' => Yii::t('app', 'Img'),
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }

    /**
     * Gets query for [[UpdatedBy0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updatedBy']);
    }

    /**
     * Gets query for [[BlogArticleBlogCategories]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleBlogCategoryQuery
     */
    public function getBlogArticleBlogCategories()
    {
        return $this->hasMany(BlogArticleBlogCategory::className(), ['articleId' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery|BlogCategoryQuery
     */
    public function getCategories()
    {
        return $this->hasMany(BlogCategory::className(), ['id' => 'categoryId'])->viaTable('blog_article_blog_category', ['articleId' => 'id']);
    }

    /**
     * Gets query for [[BlogArticleTags]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleTagQuery
     */
    public function getBlogArticleTags()
    {
        return $this->hasMany(BlogArticleTag::className(), ['articleId' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery|TagQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tagId'])->viaTable('blog_article_tag', ['articleId' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BlogArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogArticleQuery(get_called_class());
    }
}
