<?php

namespace frontend\models;

use Yii;
use common\models\user\User;
use yii\helpers\Json;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string $title
 * @property string $data decoded phones or etc
 * @property string $icon1 big icon
 * @property string $icon2 small icon
 * @property int $sortOrder
 * @property int $status 0 - desibled,1-enabled
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class Contacts extends \yii\db\ActiveRecord
{
    const DESIBLED = 0;
    const ENEBLED = 1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'data', 'icon1', 'icon2', 'status', 'createdAt', 'createdBy', 'updatedBy'], 'required'],
            [['data', 'icon1', 'icon2'], 'string'],
            [['sortOrder', 'status', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updatedBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'data' => Yii::t('app', 'Data'),
            'icon1' => Yii::t('app', 'Icon1'),
            'icon2' => Yii::t('app', 'Icon2'),
            'sortOrder' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    public function makeContacts()
    {
        if($this->hasContacts()){
            return Json::decode($this->data);
        }
        return null;
    }

    public function hasContacts()
    {
        return !empty($this->data);
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
     * @return ContactsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactsQuery(get_called_class());
    }
}
