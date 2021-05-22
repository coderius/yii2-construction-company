<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use frontend\models\Search as ElasticSearch;
use frontend\models\BlogArticle;

class SearchController extends Controller{
    
    public function actionCreateIndex() {

        // ElasticSearch::createIndex();

        foreach(BlogArticle::find()->where([
            'status' => BlogArticle::ACTIVE_STATUS
        ])->all() as $post) {
            $elastic = new ElasticSearch();
            $elastic->fill($post);
            $elastic->save();
        }
        Yii::info('The ElasticSearch index was created ('.
            ElasticSearch::index() .'/'. ElasticSearch::type() .').', __METHOD__);
    }



}