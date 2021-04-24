<?php

namespace frontend\models;

use Yii;
use common\models\user\User;
use common\models\UserProfile;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property int $isHome
 * @property string $alias
 * @property string $metaTitle
 * @property string $metaDesc
 * @property int $status 0-desible, 1- enable
 * @property string|null $storyHeader1
 * @property string|null $storyHeader2
 * @property string $storyText
 * @property string|null $storyImg
 * @property string $storyButtonTitle
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isHome', 'status', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'metaTitle', 'metaDesc', 'status', 'storyText', 'storyButtonTitle', 'createdAt', 'createdBy', 'updatedBy'], 'required'],
            [['storyText', 'storyImg'], 'string'],
            [['alias', 'metaTitle', 'metaDesc', 'storyHeader1', 'storyHeader2', 'storyButtonTitle'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'isHome' => Yii::t('app', 'Is Home'),
            'alias' => Yii::t('app', 'Alias'),
            'metaTitle' => Yii::t('app', 'Meta Title'),
            'metaDesc' => Yii::t('app', 'Meta Desc'),
            'status' => Yii::t('app', 'Status'),
            'storyHeader1' => Yii::t('app', 'Story Header1'),
            'storyHeader2' => Yii::t('app', 'Story Header2'),
            'storyText' => Yii::t('app', 'Story Text'),
            'storyImg' => Yii::t('app', 'Story Img'),
            'storyButtonTitle' => Yii::t('app', 'Story Button Title'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[CreatedBy0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }

    /**
     * Gets query for [[UpdatedBy0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'updatedBy']);
    }

    /**
     * {@inheritdoc}
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }
}
