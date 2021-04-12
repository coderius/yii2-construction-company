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
use frontend\services\widgets\CarouselService;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Site controller
 */
class BlogController extends BaseController
{
    // private $htmlMetaComponent;
    private $articleService;
    private $carouselService;

    public function __construct(
        $id, 
        $module, 
        ArticleService $articleService,
        CarouselService $carouselService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->articleService = $articleService;
        $this->carouselService = $carouselService;
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
    public function actionIndex($pageNum = null)
    {
        return $this->render('index');
    }

    public function actionCategory($alias, $pageNum = null)
    {
        return $this->render('category');
    }

    public function actionTag($alias, $pageNum = null)
    {
        return $this->render('tag');
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
