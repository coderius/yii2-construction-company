<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\services\blog\ArticleService;
use frontend\services\widgets\OwlCarouselService;
use frontend\services\blog\BlogService;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\BlogArticleSearch;
use frontend\models\BlogCategory;
use frontend\models\Tag;

/**
 * Site controller
 */
class BlogController extends BaseController
{
    // private $htmlMetaComponent;
    private $articleService;
    private $carouselService;
    private $blogService;

    public function __construct(
        $id,
        $module,
        ArticleService $articleService,
        OwlCarouselService $carouselService,
        BlogService $blogService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->articleService = $articleService;
        $this->carouselService = $carouselService;
        $this->blogService = $blogService;
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
     * Displays blog all posts.
     *
     * @return mixed
     */
    public function actionIndex($pageNum = null)
    {
        $searchModel = new BlogArticleSearch();
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
            Yii::$app->response->redirect(Url::toRoute(['/blog']));
        }
        
        //Meta tags
        $this->blogService->makeBlogMetaTags();

        return $this->render('index',  [
            'heading' => 'Блог про ремонт квартир',
            'crumbName' => 'Блог про ремонт',
            'heading2' => 'Все материалы блога про ремонт квартир.',
            'heading3' => 'Блог о ремонте',
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCategory($alias, $pageNum = null)
    {
        $page = BlogCategory::findOne(['alias' => $alias]);

        if(null == $page)
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        }

        // var_dump($page);die;
        $searchModel = new BlogArticleSearch();
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
            Yii::$app->response->redirect(Url::toRoute(['/blog']));
        }
        
        
        // var_dump($page);
        //Meta tags
        $this->blogService->makeBlogMetaTags([
            'metaTitle' => $page->metaTitle,
            'description' => $page->metaDesc,
        ]);

        return $this->render('category',  [
            'heading' => $page->header,
            'crumbName' => $page->header,
            'heading2' => "Все материалы блога по теме '{$page->header}'",
            'heading3' => $page->metaTitle,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionTag($alias, $pageNum = null)
    {
        $searchModel = new BlogArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $alias, 'tag' );
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
            Yii::$app->response->redirect(Url::toRoute(['/blog']));
        }
        
        $page = Tag::findOne(['alias' => $alias]);
        
        //Meta tags
        $this->blogService->makeBlogMetaTags([
            'metaTitle' => $page->metaTitle,
            'description' => $page->metaDesc,
        ]);

        return $this->render('tag',  [
            'heading' => $page->header,
            'crumbName' => $page->header,
            'heading2' => "Все материалы по тегу '{$page->header}'",
            'heading3' => $page->metaTitle,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionArticle($alias)
    {
        $article = $this->articleService->getSingleArticle($alias);
        
        if($article == NULL)
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
            //throw new \yii\web\NotFoundHttpException;
        }
        //Meta tags
        $this->articleService->makeArticleMetaTags($article, $this);
        $tags = $this->articleService->getArticleTags($article);
        $author = $this->articleService->getArticleAuthor($article);
        $sidebar = $this->articleService->getSidebar();
        $carousel = $this->carouselService->makeEntity();
        
        return $this->render('article', compact('article','tags', 'author', 'sidebar', 'carousel'));
    }


}
