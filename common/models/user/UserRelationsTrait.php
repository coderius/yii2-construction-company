<?php
namespace common\models\user;

use frontend\models\BlogArticle;
use frontend\models\BlogCategory;
use frontend\models\Contacts;
use frontend\models\MenuTop;
use frontend\models\Page;
use frontend\models\Tag;
use common\models\UserProfile;

trait UserRelationsTrait{
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

