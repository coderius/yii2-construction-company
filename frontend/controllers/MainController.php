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
use frontend\services\widgetLayout\WidgetLayoutService;

/**
 * Site controller
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
    )
    {
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
        $this->layout = 'home';

        $model = $this->mainService->makeHome();

        $template = $this->widgetLayoutService->getTemplate($model->id, WidgetLayoutService::PAGETYPE_PAGE);
        // var_dump($template);die;
        Yii::$app->getView()->params['WidgetLayout']['template'] = $template;

        $carousel = $this->carouselService->getEntities(1);

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
