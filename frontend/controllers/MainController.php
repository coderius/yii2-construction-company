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
use frontend\services\main\MainService;
use frontend\services\widgets\CarouselService;

/**
 * Site controller
 */
class MainController extends BaseController
{
    private $mainService;
    private $carouselService;

    public function __construct(
        $id,
        $module,
        MainService $mainService,
        CarouselService $carouselService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->mainService = $mainService;
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
    public function actionIndex()
    {
        $model = $this->mainService->makeHome();
        
        $carousel = $this->carouselService->getEntities();

        $this->mainService->makeMetaTags([
            'metaTitle' => $model->metaTitle,
            'description' => $model->metaDesc,
        ]);

        return $this->render('index', compact('model', 'carousel'));
    }

    public function actionPage()
    {
        return $this->render('about');
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

    public function actionContact()
    {
        return $this->render('contact');
    }

}
