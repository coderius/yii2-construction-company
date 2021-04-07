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

/**
 * Site controller
 */
class MainController extends BaseController
{
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
        return $this->render('index');
    }

    public function actionPage()
    {
        return $this->render('about');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionService()
    {
        return $this->render('service');
    }

    public function actionTeam()
    {
        return $this->render('team');
    }

    public function actionPortfolio()
    {
        return $this->render('portfolio');
    }

    public function actionContact()
    {
        return $this->render('contact');
    }

}
