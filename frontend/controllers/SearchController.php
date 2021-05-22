<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use frontend\models\Search;
use frontend\models\SearchingSiteModel;
use frontend\models\SuggestersSearch;
use Yii;
use yii\elasticsearch\Query;
use yii\data\ActiveDataProvider;
use yii\db\QueryBuilder;
use yii\helpers\Url;
use frontend\services\search\SearchService;
use frontend\services\search\ISearchService;

/**
 * Site controller.
 */
class SearchController extends BaseController
{
    private $searchService;

    public function __construct(
        $id,
        $module,
        ISearchService $searchService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        
        $this->searchService = $searchService;
    }
    
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
        ];
    }

    /**
     * Action Global
     *
     * @return mixed
     */
    public function actionGlobal()
    {

    }

    public function actionAutoComplete()
    {
        if(\Yii::$app->request->isAjax){
            $query = Yii::$app->request->post('query');
            $query = trim($query);
            $isEmptyQ = empty($query);
            if(!$isEmptyQ){

                $provider = $this->searchService->providerSuggesters($query);
                $result = false;
                if($provider->count > 0){
                    $result = [];
                    foreach($provider->getModels() as $model){
                        $result[] = $model;
                    }
                }

                return $this->asJson(['success' => $result]);
            }else{
                // return $this->asJson(['empty' => $isEmptyQ]);
            }

        }
    }

    /**
     * actionSearch function
     *
     * @param string $queryString
     * @param int|null $pageNum
     * @return view yii\web\View
     */
    public function actionSearch($pageNum = null)
    {
        $dataProvider = $this->searchService->providerSearch(Yii::$app->request->queryParams);
        // var_dump();
        $itemsInPage = 10;
        $dataProvider->pagination->pageSize = $itemsInPage;
        $queryString = Yii::$app->request->queryParams['q'];

        if($pageNum > $dataProvider->pagination->pageCount)
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        }

        if($pageNum == 1)
        {
            Yii::$app->response->redirect(Url::toRoute(['search/?q='. $queryString]));
        }
        
        $this->searchService->makeMetaTags($queryString);

        return $this->render('search', compact('queryString', 'dataProvider'));
    }



    public function searchElastic($queryString = 'Технолог')
    {
        $query = Search::find();

        $queryParts = [];

        // exact match on name field, which is a keyword and not analyzed
        // exact match on unanalyzed title
        $queryParts[] = [
            'bool' => [
                'should' => [
                    ['term' => ['content' => $queryString]],
                    ['term' => ['title' => $queryString]],
                    ['match' => ['title' => $queryString]],
                ],
                'minimum_should_match' => 1,
            ]
        ];

        $query->from(Search::index(), Search::type());

        $query->highlight([
            'fields' => [
                'title' => ['fragment_size' => 5000, 'number_of_fragments' => 1],
                'content' => ['fragment_size' => 100, 'number_of_fragments' => 5],
            ],
        ]);

        $provider = new ActiveDataProvider(
            [
                // 'query' => SearchActiveRecord::search($q, $version, $language, $type),
                'query' => $query,
                'key' => 'primaryKey',
                'sort' => false,
            ]
        );

        // $query->query(['match' => ['title' => "$queryString"]])
        // ->highlight([])
        // ->all();

        // foreach ($provider->getModels() as $model) {
        //     echo $model->getHighlight();
        // }
        var_dump($provider->getModels());
        die;

        // $query = new Query();
        // // $query->storedFields('id, name')
        // $query->source(['title']);
        // $query->from('constructioncompany', 'blog_article')
        //     ->limit(10);
        // $query->filter = ['title' => $q];
        // $command = $query->createCommand();
        // // $params['body']['query']['match']['title'] = $q;

        // $rows = $command->search(

        //     // [
        //     //     // 'index' => $this->index,
        //     //     // 'type' => $this->type,
        //     //     'body' => [
        //     //         'query' => [
        //     //             'match' =>  [
        //     //                 'title' => $q,
        //     //             ],
        //     //         ]
        //     //     ]

        //     // ]
        // );
        // var_dump($rows);
        // die;

        // $query->addOptions(['track_total_hits' => 'true']);

        // // build and execute the query
        // $command = $query->createCommand();
        // $rows = $command->search(
        //     // $params = [
        //     //     // 'index' => $this->index,
        //     //     // 'type' => $this->type,
        //     //     'body' => [
        //     //         'query' => [
        //     //             'multi_match' =>  [
        //     //                 'query'=>$q,
        //     //             ],
        //     //         ]
        //     //         ]
        //     // ]

        // );

        // $query = Search::find();
        // $query->query(['query_string'=>[
        //     'default_field'=>'_all',
        //     'query'=>"*".$q."*",
        // ]]);

        // $elastic = new Search();

        // if ($elastic->save()) {
        //     // echo "Added Successfully";
        // } else {
        //     // echo "Error";
        // }

        // var_dump(Search::get(1));
        // var_dump($rows);die;
    }


}
