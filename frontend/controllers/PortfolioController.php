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
use frontend\services\blog\BlogService;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\BlogArticleSearch;
use frontend\models\BlogCategory;
use frontend\models\Tag;

/**
 * Site controller
 */
class PortfolioController extends BaseController
{
    // private $htmlMetaComponent;
    private $articleService;
    private $carouselService;
    private $blogService;

    public function __construct(
        $id,
        $module,
        ArticleService $articleService,
        CarouselService $carouselService,
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
        // if($pageNum > ceil($dataProvider->getTotalCount() / $itemsInPage))
        // {
        //     throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        // }
        
        //если введена еденица, делаем редирект на без 1
        if($pageNum == 1)
        {
            Yii::$app->response->redirect(Url::toRoute(['/portfolio', true]));
        }

        return $this->render('index',  [
            
        ]);
    }

    public function actionCategory($alias, $pageNum = null)
    {
        

        return $this->render('category',  [
        ]);
    }

    public function actionTag($alias, $pageNum = null)
    {
        

        return $this->render('tag',  [
        ]);
    }

    
}
