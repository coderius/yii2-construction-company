<?php

namespace frontend\models\sidebar;

use Yii;
use yii\base\Model;
use frontend\models\BlogArticle;

/**
 * Sidebar
 */
class Sidebar extends Model
{
    public $searchForm;
    public $recentPosts;
    public $popularPosts;
    public $popularPostText;
    public $categories;
    public $tagsCloud;
    public $randomPosts;
    public $randomPostsPics = [];

    private $_randomPostsPicsKey = null;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[], 'required'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [];
    }

    public function hasRecentPosts()
    {
        return (bool) $this->recentPosts;
    }

    public function hasSearchForm()
    {
        return (bool) $this->searchForm;
    }

    public function hasPopularPosts()
    {
        return (bool) $this->popularPosts;
    }

    public function hasCategories()
    {
        return (bool) $this->categories;
    }

    public function hasTagsCloud()
    {
        return (bool) $this->tagsCloud;
    }
    
    public function hasRandomPosts()
    {
        return (bool) $this->randomPosts;
    }

    public function hasPopularPostText()
    {
        return (bool) $this->popularPostText;
    }

    public function hasRandomPostsPics()
    {
        return !empty($this->randomPostsPics);
    }

    public function equalRandomPost(BlogArticle $post)
    {
        return $this->randomPost === $post;
    }

    public function equalRandomPostsPics(BlogArticle $post)
    {
        return $this->randomPostsPics === $post;
    }

    public function nextRandomPostsPics()
    {
        foreach($this->randomPostsPics as $k => $v){
            if($k == $this->_randomPostsPicsKey) continue;
            $this->_randomPostsPicsKey = $k;
            return $v;
        }

        
    }





}
