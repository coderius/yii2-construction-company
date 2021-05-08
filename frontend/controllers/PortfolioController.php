<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PortfolioSearch;
use frontend\models\PortfolioCategorySearch;
use frontend\models\PortfolioCategory;
use frontend\models\Portfolio;
use frontend\services\portfolio\PortfolioService;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Tag;

class PortfolioController extends \yii\web\Controller
{
    public $crumbNamePortfolio = "Портфолио";

    private $portfolioService;

    public function __construct(
        $id,
        $module,
        PortfolioService $portfolioService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->portfolioService = $portfolioService;
    }

    public function actionIndex($pageNum = null)
    {
        $searchModel = new PortfolioCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $itemsInPage = 9;
        $dataProvider->pagination->pageSize = $itemsInPage;
        // var_dump($dataProvider->getModels());die;

        if($pageNum > ceil($dataProvider->getTotalCount() / $itemsInPage))
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        }

        //если введена еденица, делаем редирект на без 1
        if($pageNum == 1)
        {
            Yii::$app->response->redirect(Url::toRoute(['/portfolios']));
        }

        //Meta tags
        $this->portfolioService->makeMetaTags();

        $allCount = $this->portfolioService->activeCategoriesCount();
        $header1 = "Наши работы";
        $header2 = "Фото наших объектов";

        $tags = $this->portfolioService->activeCategoriesTags();

        return $this->render('index', compact('header1', 'header2', 'dataProvider', 'tags', 'allCount'));
    }

    public function actionCategory($alias, $pageNum = null)
    {
        $category = PortfolioCategory::find()->where(['alias' => $alias])->one();

        if(!$category)
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        }

        $this->commitCounter($category);

        $searchModel = new PortfolioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $alias);
        $itemsInPage = 9;
        $dataProvider->pagination->pageSize = $itemsInPage;
// var_dump($dataProvider->getModels());die;
        if($pageNum > ceil($dataProvider->getTotalCount() / $itemsInPage))
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        }

        //если введена еденица, делаем редирект на без 1
        if($pageNum == 1)
        {
            Yii::$app->response->redirect(Url::toRoute(['/portfolios/category/'.$alias]));
        }

        //Meta tags
        $this->portfolioService->makeMetaTags([
            'metaTitle' => "Тег: " . $category->metaTitle,
            'description' => "Теги по теме: " . $category->metaDesc,
        ]);

        return $this->render('category',  [
            'heading' => $category->headerShort,
            'crumbName' => $category->headerShort,
            'crumbNamePortfolio' => $this->crumbNamePortfolio,
            'heading2' => "Все материалы категории '{$category->headerShort}'",
            'heading3' => $category->headerLong,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionTag($alias, $pageNum = null)
    {
        $searchModel = new PortfolioCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $alias, 'tag');
        $itemsInPage = 9;
        $dataProvider->pagination->pageSize = $itemsInPage;
        // var_dump($dataProvider->getModels());die;

        if($pageNum > ceil($dataProvider->getTotalCount() / $itemsInPage))
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        }

        //если введена еденица, делаем редирект на без 1
        if($pageNum == 1)
        {
            Yii::$app->response->redirect(Url::toRoute(['/portfolios/tag' . $alias]));
        }

        $page = Tag::findOne(['alias' => $alias]);
        $this->commitCounter($page);
        $allCount = $this->portfolioService->activeCategoriesCount();

        //Meta tags
        $this->portfolioService->makeMetaTags([
            'metaTitle' => "Тег: " . $page->metaTitle,
            'description' => "Теги по теме: " . $page->metaDesc,
        ]);

        $header1 = "Наши работы";
        $header2 = "Все материалы по тегу '{$page->header}'";

        $tags = $this->portfolioService->activeCategoriesTags();

        return $this->render('tag', compact('header1', 'header2', 'dataProvider', 'tags', 'allCount'));
    }

}
