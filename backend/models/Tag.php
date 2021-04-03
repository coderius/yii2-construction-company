<?php

namespace backend\models;

use Yii;
use common\models\user\User;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $alias
 * @property string $metaTitle
 * @property string $metaDesc
 * @property string $header
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property BlogArticleTag[] $blogArticleTags
 * @property BlogArticle[] $articles
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'metaTitle', 'metaDesc', 'header', 'createdAt', 'createdBy', 'updatedBy'], 'required'],
            [['createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
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
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[BlogArticleTags]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleTagQuery
     */
    public function getBlogArticleTags()
    {
        return $this->hasMany(BlogArticleTag::className(), ['tagId' => 'id']);
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleQuery
     */
    public function getArticles()
    {
        return $this->hasMany(BlogArticle::className(), ['id' => 'articleId'])->viaTable('blog_article_tag', ['tagId' => 'id']);
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
     * @return TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
