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
 * This is the model class for table "blog_article".
 *
 * @property int $id
 * @property string $alias
 * @property string $metaTitle
 * @property string $metaDesc
 * @property int $status 0-desible, 1- enable
 * @property string|null $header1
 * @property string $text
 * @property string|null $img
 * @property string|null $imgAlt
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
    public $selectedCategories = [];//virtual var use in form create or update
    public $selectedTags = [];//virtual var use in form create or update
    
    public $file;//загружаемое изображение

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
        return 'blog_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'metaTitle', 'metaDesc', 'status', 'text', 'header1', 'selectedCategories'], 'required'],
            [['status', 'viewCount', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['text', 'img', 'imgAlt'], 'string'],
            [['alias', 'metaTitle', 'metaDesc', 'header1'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updatedBy' => 'id']],
            // [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['createdAt', 'updatedAt', 'createdBy', 'updatedBy', 'viewCount', 'selectedTags'], 'safe'],
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
            'imgAlt' => Yii::t('app', 'Img Alt'),
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
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
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
                    
                    'selectedCategories' => [
                        ActiveRecord::EVENT_AFTER_INSERT  => [$this, 'makeCategoriesRelation'],
                        ActiveRecord::EVENT_AFTER_UPDATE  => [$this, 'makeCategoriesRelation'] 
                    ],
                    
                ],
            ],
            'uploadFileBehavior' => [
                'class' => UploadFileBehavior::class,
                'nameOfAttributeStorage' => 'img',
                'directories' => [
                    [
                        'path' => function($attributes){
                            return \Yii::getAlias('@blogPostHeaderPicsPath/' . $attributes['id'] . '/big/');
                        },
                        'hendler' => function($fileTempName, $newFilePath){
                            Image::thumbnail($fileTempName, 900, 900*2/3)
                            ->copy()
                            ->crop(new Point(0, 0), new Box(900, 900*2/3))
                            ->save($newFilePath, ['quality' => 80]);
                            sleep(1);
                        }
                    ],
                    [
                        'path' => function($attributes){
                            return \Yii::getAlias('@blogPostHeaderPicsPath/' . $attributes['id'] . '/middle/');
                        },
                        'hendler' => function($fileTempName, $newFilePath){
                            Image::thumbnail($fileTempName, 400, 400*2/3)
                            ->save($newFilePath, ['quality' => 80]);
                            sleep(1);
                        }
                    ],
                    [
                        'path' => function($attributes){
                            return \Yii::getAlias('@blogPostHeaderPicsPath/' . $attributes['id'] . '/small/');
                        },
                        'hendler' => function($fileTempName, $newFilePath){
                            Image::thumbnail($fileTempName, 150, 150*2/3)
                            ->save($newFilePath, ['quality' => 80]);
                            sleep(1);
                        }
                    ],
                ]
            ],

        ];
    }

    public function initSelectedVirtualAttributes()
    {
        $this->selectedCategories = ArrayHelper::getColumn($this->getCategories()->asArray()->all(), 'id');
        $this->selectedTags = ArrayHelper::getColumn($this->getTags()->asArray()->all(), 'id');
        Yii::info('Selected Virtual Attributes is loaded.', __METHOD__);
    }


    public function makeTagsRelation($event, $attribute)
    {
        // var_dump($this->$attribute);die;
        if(!empty($this->$attribute)){
            BlogArticleTag::deleteAll(['articleId' => $this->id]);
            
            foreach($this->$attribute as $selected){
                $relation = new BlogArticleTag();
                $relation->articleId = $this->id;
                $relation->tagId = $selected;
                $relation->save();
            }
        }
    }

    public function makeCategoriesRelation($event, $attribute)
    {
        // var_dump($this->$attribute);die;
        if(!empty($this->$attribute)){
            BlogArticleBlogCategory::deleteAll(['articleId' => $this->id]);

            $relation = new BlogArticleBlogCategory();
            $relation->articleId = $this->id;
            $relation->categoryId = $this->$attribute;
            $relation->save();
            
        }
    }


    /**
     * Gets query for [[CreatedBy0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(User::class, ['id' => 'createdBy']);
    }

    /**
     * Gets query for [[UpdatedBy0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdatedBy0()
    {
        return $this->hasOne(User::class, ['id' => 'updatedBy']);
    }

    /**
     * Gets query for [[BlogArticleBlogCategories]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleBlogCategoryQuery
     */
    public function getBlogArticleBlogCategories()
    {
        return $this->hasMany(BlogArticleBlogCategory::class, ['articleId' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery|BlogCategoryQuery
     */
    public function getCategories()
    {
        return $this->hasMany(BlogCategory::class, ['id' => 'categoryId'])->viaTable('blog_article_blog_category', ['articleId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategory::class, ['id' => 'categoryId'])->viaTable('blog_article_blog_category', ['articleId' => 'id']);
    }

    /**
     * Gets query for [[BlogArticleTags]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleTagQuery
     */
    public function getBlogArticleTags()
    {
        return $this->hasMany(BlogArticleTag::class, ['articleId' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery|TagQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tagId'])->viaTable('blog_article_tag', ['articleId' => 'id']);
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
