<?php

namespace backend\models;

use Yii;
// use common\models\user\User;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $role
 * @property string $username
 * @property string $authKey
 * @property string $password
 * @property string|null $passwordResetToken
 * @property string $email
 * @property int $status
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property string|null $verificationToken
 *
 * @property BlogArticle[] $blogArticles
 * @property BlogArticle[] $blogArticles0
 * @property BlogCategory[] $blogCategories
 * @property BlogCategory[] $blogCategories0
 * @property Contacts[] $contacts
 * @property Contacts[] $contacts0
 * @property MenuTop[] $menuTops
 * @property MenuTop[] $menuTops0
 * @property Page[] $pages
 * @property Page[] $pages0
 * @property Tag[] $tags
 * @property Tag[] $tags0
 */
class UserManage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'username', 'authKey', 'password', 'email', 'createdAt'], 'required'],
            [['status', 'createdAt', 'updatedAt'], 'integer'],
            [['role', 'username', 'password', 'passwordResetToken', 'email', 'verificationToken'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['passwordResetToken'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role' => Yii::t('app', 'Role'),
            'username' => Yii::t('app', 'Username'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'password' => Yii::t('app', 'Password'),
            'passwordResetToken' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'verificationToken' => Yii::t('app', 'Verification Token'),
        ];
    }

    /**
     * Gets query for [[BlogArticles]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleQuery
     */
    public function getBlogArticles()
    {
        return $this->hasMany(BlogArticle::className(), ['createdBy' => 'id']);
    }

    /**
     * Gets query for [[BlogArticles0]].
     *
     * @return \yii\db\ActiveQuery|BlogArticleQuery
     */
    public function getBlogArticles0()
    {
        return $this->hasMany(BlogArticle::className(), ['updatedBy' => 'id']);
    }

    /**
     * Gets query for [[BlogCategories]].
     *
     * @return \yii\db\ActiveQuery|BlogCategoryQuery
     */
    public function getBlogCategories()
    {
        return $this->hasMany(BlogCategory::className(), ['createdBy' => 'id']);
    }

    /**
     * Gets query for [[BlogCategories0]].
     *
     * @return \yii\db\ActiveQuery|BlogCategoryQuery
     */
    public function getBlogCategories0()
    {
        return $this->hasMany(BlogCategory::className(), ['updatedBy' => 'id']);
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery|ContactsQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['createdBy' => 'id']);
    }

    /**
     * Gets query for [[Contacts0]].
     *
     * @return \yii\db\ActiveQuery|ContactsQuery
     */
    public function getContacts0()
    {
        return $this->hasMany(Contacts::className(), ['updatedBy' => 'id']);
    }

    /**
     * Gets query for [[MenuTops]].
     *
     * @return \yii\db\ActiveQuery|MenuTopQuery
     */
    public function getMenuTops()
    {
        return $this->hasMany(MenuTop::className(), ['createdBy' => 'id']);
    }

    /**
     * Gets query for [[MenuTops0]].
     *
     * @return \yii\db\ActiveQuery|MenuTopQuery
     */
    public function getMenuTops0()
    {
        return $this->hasMany(MenuTop::className(), ['updatedBy' => 'id']);
    }

    /**
     * Gets query for [[Pages]].
     *
     * @return \yii\db\ActiveQuery|PageQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['createdBy' => 'id']);
    }

    /**
     * Gets query for [[Pages0]].
     *
     * @return \yii\db\ActiveQuery|PageQuery
     */
    public function getPages0()
    {
        return $this->hasMany(Page::className(), ['updatedBy' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery|TagQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['createdBy' => 'id']);
    }

    /**
     * Gets query for [[Tags0]].
     *
     * @return \yii\db\ActiveQuery|TagQuery
     */
    public function getTags0()
    {
        return $this->hasMany(Tag::className(), ['updatedBy' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
