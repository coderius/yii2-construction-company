<?php
namespace common\models\user;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\components\rbac\Rbac;
use common\models\UserProfile;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $avatar
 * @property string $group_user - enum('user', 'admin')
 * @property string $password
 * @property string $passwordResetToken
 * @property string $email
 * @property string $authKey
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const SIGNUP_TYPE_SIGNUPFORM  = 1;
    const SIGNUP_TYPE_SOCIALLOGIN = 2;

    const AUTH_TYPE_LOGINFORM  = 1;
    const AUTH_TYPE_SOCIALLOGIN = 2;
    
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;
    
    const GROUP_USER = 'user';
    const GROUP_ADMIN = 'admin';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [//Использование поведения TimestampBehavior ActiveRecord
                'class' => TimestampBehavior::class,
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['createdAt'],
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],

                ],
                // 'value' => function(){
                //                 return gmdate("Y-m-d H:i:s");
                // },
            //    'value' => new \yii\db\Expression('NOW()'),

            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_BLOCKED]],
        ];
    }

    
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'passwordResetToken' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->passwordResetToken = null;
    }
    
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
    
    //if(\Yii::$app->user->identity->isNotAdmin()) etc...
    public static function isAdmin()
    {
        if (\Yii::$app->user->isGuest){
            return false;
        }else{
            return \Yii::$app->user->can(Rbac::ROLE_ADMIN);
        }
    }
    
    public static function isNotAdmin()
    {
        if (\Yii::$app->user->isGuest){
            return true;
        }else{
            return (\Yii::$app->user->can(Rbac::ROLE_ADMIN) == false);
        }
    }
    
    /**
     * -----------------
     * Relations methods
     * -----------------
     */

    /**
     * Gets query for [[UserProfile]].
     *
     * @return \yii\db\ActiveQuery|UserProfileQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::class, ['userId' => 'id']);
    }

    /**
     * Gets query for [[UserProfiles]].
     *
     * @return \yii\db\ActiveQuery|UserProfileQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::class, ['createdBy' => 'id']);
    }

}
