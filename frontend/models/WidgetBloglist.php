<?php

namespace frontend\models;

use Yii;
use frontend\models\BlogArticle;
use frontend\models\BlogCategory;
use yii\db\Expression;

/**
 * This is the model class for table "widget_bloglist".
 *
 * @property int $id
 * @property int $widgetId
 * @property string $typeContent How to render widget from blog table
 *
 * @property Widgets $widget
 */
class WidgetBloglist extends \yii\db\ActiveRecord implements TypableBlogInterface
{
    const TYPE_CONTENT_LAST     = "last";
    const TYPE_CONTENT_POPULAR  = "popular";
    const TYPE_CONTENT_RANDOM   = "random";
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_bloglist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['widgetId', 'typeContent'], 'required'],
            [['widgetId'], 'integer'],
            [['typeContent'], 'string'],
            [['widgetId'], 'exist', 'skipOnError' => true, 'targetClass' => Widgets::className(), 'targetAttribute' => ['widgetId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'widgetId' => Yii::t('app', 'Widget ID'),
            'typeContent' => Yii::t('app', 'Type Content'),
        ];
    }

    /**
     * Gets query for [[Widget]].
     *
     * @return \yii\db\ActiveQuery|WidgetsQuery
     */
    public function getWidget()
    {
        return $this->hasOne(Widgets::className(), ['id' => 'widgetId']);
    }

    public function getContentType(){
        return $this->typeContent;
    }

    public function getBlogList(){
        $type = $this->getContentType();

        switch ($type) {
            case self::TYPE_CONTENT_LAST:
                $model = self::getLastPosts();
                break;
            case self::TYPE_CONTENT_POPULAR:
                $model = self::getPopularPosts();
                break;
            case self::TYPE_CONTENT_RANDOM:
                $model = self::getRandomPosts();
                break;
        }

        return $model;
    }

    protected static function getPopularPosts($limit=6)
    {
        $items = BlogArticle::find()
            ->active()
            ->with([
                'createdBy0' => function ($query) {
                    $query->select(['id', 'username']);
                }
                ,
                'category' => function ($query) {
                    $query->select(['id', 'header']);
                }
            ])
            // ->with('category')
            ->limit($limit)
            ->orderBy(['viewCount' => SORT_DESC])
            ->all();

        return $items;
    }

    protected static function getRandomPosts($limit=6)
    {
        $items = BlogArticle::find()
            ->active()
            ->with([
                'createdBy0' => function ($query) {
                    $query->select(['id', 'username']);
                }
                ,
                'category' => function ($query) {
                    $query->select(['id', 'header']);
                }
            ])
            // ->with('category')
            ->limit($limit)
            ->orderBy([new Expression('rand()')])
            ->all();

        return $items;
    }

    protected static function getLastPosts($limit=6)
    {
        $items = BlogArticle::find()
            ->active()
            ->with([
                'createdBy0' => function ($query) {
                    $query->select(['id', 'username']);
                }
                ,
                'category' => function ($query) {
                    $query->select(['id', 'header', 'alias']);
                }
            ])
            ->limit($limit)
            ->orderBy(['createdAt' => SORT_DESC])
            ->all();

        return $items;
    }

    /**
     * {@inheritdoc}
     * @return WidgetBloglistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetBloglistQuery(get_called_class());
    }
}
