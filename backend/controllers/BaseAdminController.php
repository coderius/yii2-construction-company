<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use common\components\rbac\Rbac;

class BaseAdminController extends Controller
{
    // по умолчанию для всего сайта
//    public $layout = '@app/views/layouts/base/main';
    
    
    public function init() {
        $ip = Yii::$app->request->userIP;
        Yii::$app->language = 'ru-RU';
//        Yii::$app->controller->enableCsrfValidation = false;
//        var_dump(\Yii::$app->user->identity->username);
        parent::init();
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [Rbac::ROLE_ADMIN, Rbac::PERMISSION_ADMIN_PANEL],
                        
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
//                    var_dump($rule);
//                    var_dump($action);
                    Yii::$app->session->setFlash('danger', 'Доступно только для админа!');
                    return $this->redirect(Yii::$app->urlManagerFrontend->createUrl(['/login']));
                },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            

        ];
    }
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ]
        ];
    }
    
    
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
//        $ip = Yii::$app->geoip->ip("208.113.83.165");
//        var_dump($ip->country->iso_code);die;

        return parent::beforeAction($action);
    }
    
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        $handler = Yii::$app->errorHandler;
        
        if ($exception !== null) {
            return $this->render('//error/error', compact('exception', 'handler'));
        }
    }
    
        /**
     * Login action.
     *
     * @return string
     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        } else {
//            return $this->render('login', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->homeUrl = Yii::$app->urlManagerFrontend->createUrl(['/']);
        return $this->goHome();
    }
    
    
    
}

