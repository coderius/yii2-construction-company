<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\user\User;
use common\components\rbac\Rbac;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        // if (!$this->validate()) {
        //     return null;
        // }
        
        // $user = new User();
        // $user->username = $this->username;
        // $user->email = $this->email;
        // $user->setPassword($this->password);
        // $user->generateAuthKey();
        // $user->generateEmailVerificationToken();
        // return $user->save() && $this->sendEmail($user);

        //----------------------------------
        //New
        //----------------------------------
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role = User::GROUP_USER;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        $user->save();
        
        // нужно добавить следующие три строки:
        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole(Rbac::ROLE_USER);
        $auth->assign($userRole, $user->getId());
        
        return $user;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
