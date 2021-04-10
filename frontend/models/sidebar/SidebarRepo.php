<?php

namespace frontend\models\sidebar;
use frontend\models\BlogArticle;

class SidebarRepo
{

    public function getRecentPost()
    {
        // $subQuery = (new \yii\db\Query())->from('user');

        // $rows = (new \yii\db\Query())
        //     ->select(['id', 'header1', 'img', 'imgAlt'])
        //     ->from('blog_article ba')
        //     ->leftJoin(['u' => $subQuery], 'u.id = ba.createdBy')
        //     ->where(['last_name' => 'Smith'])
        //     ->limit(5)
        //     ->orderBy(['createdAt' => SORT_DESC])
        //     ->all();

        $items = BlogArticle::find()
            ->select(['id', 'header1', 'img', 'imgAlt'])
            ->active()
            ->with(['createdBy0', 'category'])
            // ->with('category')
            ->limit(5)
            ->orderBy(['createdAt' => SORT_DESC])
            ->all();

        return $items;
    }

}