<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use frontend\models\Search;
use frontend\services\main\MainService;
use frontend\services\widgetLayout\WidgetLayoutService;
use frontend\services\widgets\CarouselService;
use Yii;
use yii\elasticsearch\Query;
use yii\data\ActiveDataProvider;
use yii\db\QueryBuilder;

/**
 * Site controller.
 */
class MainController extends BaseController
{
    private $mainService;
    private $carouselService;
    private $widgetLayoutService;

    public function __construct(
        $id,
        $module,
        MainService $mainService,
        CarouselService $carouselService,
        WidgetLayoutService $widgetLayoutService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->mainService = $mainService;
        $this->carouselService = $carouselService;
        $this->widgetLayoutService = $widgetLayoutService;
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = '_home';
        // $this->search();
        // die;
        $model = $this->mainService->makeHome();

        $template = $this->widgetLayoutService->getTemplate($model->id, WidgetLayoutService::PAGETYPE_PAGE);
        // Past to view vars and then to widget WidgetLayout
        Yii::$app->getView()->params['WidgetLayout']['template'] = $template;

        $carousel = $this->carouselService->getEntities(1);

        $this->mainService->makeMetaTags([
            'metaTitle' => $model->metaTitle,
            'description' => $model->metaDesc,
        ]);

        return $this->render('index', compact('model', 'carousel'));
    }

    public function search($queryString = 'Технолог')
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

    public function actionPage($alias)
    {
        $this->layout = '_page';

        $model = $this->mainService->makePage($alias);
        if ($model == null) {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        }
        $template = $this->widgetLayoutService->getTemplate($model->id, WidgetLayoutService::PAGETYPE_PAGE);

        // Past to view vars and then to widget WidgetLayout
        Yii::$app->getView()->params['WidgetLayout']['template'] = $template;
        $this->mainService->registerPageHeader($model);

        $this->mainService->makeMetaTags([
            'metaTitle' => $model->metaTitle,
            'description' => $model->metaDesc,
        ]);

        return $this->render('page', compact('model'));
    }

    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }

    // public function actionService()
    // {
    //     return $this->render('service');
    // }

    // public function actionTeam()
    // {
    //     return $this->render('team');
    // }

    public function actionContacts()
    {
        $model = $this->mainService->makeContacts();

        $this->mainService->makeMetaTags([
            'metaTitle' => 'Контакты мастеров',
            'description' => 'На данной странице Вы найдете наши контакты. Свяжитесь с нами, мы постараемся ответить на все Ваши вопросы.',
        ]);

        return $this->render('contacts', compact('model', 'form'));
    }

    public function actionSendEmail()
    {
        $form = new ContactForm();
        $this->enableCsrfValidation = true;
        if ($form->load(Yii::$app->request->post(), '')) {
            if ($form->validate()) {
                return $this->asJson(['success' => 'ok']);
            } else {
                return $this->asJson(['validation' => $form->getErrors()]);
            }
        }

        // if ($model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //     if($model->validate()){
        //         return ['success' => $model->save()];
        //     }else{
        //         return ['validation' => $model->getErrors()];
        //     }
        // }
    }
}
