<?php

namespace frontend\models\sidebar;

use frontend\models\BlogArticle;
use frontend\models\BlogCategory;
use frontend\models\Tag;
use yii\db\Expression;


class SidebarRepo
{

    //Get last posts
    public function getRecentPosts()
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
            ->limit(6)
            ->orderBy(['createdAt' => SORT_DESC])
            ->all();

        return $items;
    }

    public function getRandomPosts()
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
            ->limit(6)
            ->orderBy([new Expression('rand()')])
            ->all();

        return $items;
    }

    public function getRandomPostsPics()
    {
        $item = BlogArticle::find()
            ->select(['id', 'alias', 'img', 'imgAlt'])
            ->active()
            ->orderBy([new Expression('rand()')])
            ->all();

        return $item;
    }

    // public function getRandomPostsPics($limit = 3)
    // {
    //     $item = BlogArticle::find()
    //         ->select(['id', 'alias', 'img', 'imgAlt'])
    //         ->active()
    //         ->orderBy([new Expression('rand()')])
    //         ->limit($limit)
    //         ->one();

    //     return $item;
    // }

    public function getPopularPosts($limit=6)
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

    //Popular post text
    public function getPopularPost()
    {
        $items = BlogArticle::find()
            ->select(['alias', 'header1', 'text'])
            ->active()
            ->orderBy(['viewCount' => SORT_DESC])
            ->one();

        return $items;
    }



    //Get categories with count active articles
    public function getCategories()
    {
        $items = BlogCategory::find()
            ->alias('c')
            ->select(['c.header', 'c.alias', 'COUNT(p.id) AS surrogateArticleCount'])
            ->joinWith(['articles p' => function ($query) {
                                $query->onCondition(['p.status' => BlogArticle::ACTIVE_STATUS]);
                            }
            ])
            ->onCondition(['c.status' => BlogArticle::ACTIVE_STATUS])
            ->groupBy('c.id')
            ->orderBy(['c.header' => SORT_DESC])
            ->all();

        return $items;
    }

    public function getTagsCloud()
    {
        $items = Tag::find()
            ->alias('t')
            ->select(['t.header', 't.alias', 'COUNT(p.id) AS surrogateArticleCount'])
            ->joinWith(['articles p' => function ($query) {
                                $query->onCondition(['p.status' => BlogArticle::ACTIVE_STATUS]);
                            }
            ])
            ->groupBy('t.id')
            ->orderBy([new Expression('rand()')])
            ->all();

        return $items;
    }



}