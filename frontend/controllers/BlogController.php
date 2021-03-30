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
class BlogController extends BaseController
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
        return $this->render('article');
    }


}
