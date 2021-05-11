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
        $this->layout = '_home';

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

    public function actionPage($alias)
    {
        $this->layout = '_page';

        $model = $this->mainService->makePage($alias);
        if($model == NULL)
        {
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
            'metaTitle' => "Контакты мастеров",
            'description' => "На данной странице Вы найдете наши контакты. Свяжитесь с нами, мы постараемся ответить на все Ваши вопросы.",
        ]);
        
        return $this->render('contacts', compact('model', 'form'));
    }

    public function actionSendEmail()
    {
        $form = new ContactForm();
        $this->enableCsrfValidation = true;
        if($form->load(Yii::$app->request->post(), '')) {
            if($form->validate()){
                return $this->asJson(['success' => 'ok']);
            }else{
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
