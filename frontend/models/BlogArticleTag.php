<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "blog_article_tag".
 *
 * @property int $id
 * @property int $articleId
 * @property int $tagId
 *
 * @property BlogArticle $article
 * @property Tag $tag
 */
class BlogArticleTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_article_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articleId', 'tagId'], 'required'],
            [['articleId', 'tagId'], 'integer'],
            [['articleId', 'tagId'], 'unique', 'targetAttribute' => ['articleId', 'tagId']],
            [['articleId'], 'exist', 'skipOnError' => true, 'targetClass' => BlogArticle::className(), 'targetAttribute' => ['articleId' => 'id']],
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
            'articleId' => Yii::t('app', 'Article ID'),
            'tagId' => Yii::t('app', 'Tag ID'),
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleQuery
     */
    public function getArticle()
    {
        return $this->hasOne(BlogArticle::className(), ['id' => 'articleId']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery|TagQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tagId']);
    }

    /**
     * {@inheritdoc}
     * @return BlogArticleTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogArticleTagQuery(get_called_class());
    }
}
