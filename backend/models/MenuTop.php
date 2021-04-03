<?php

namespace backend\models;

use Yii;
use common\models\user\User;

/**
 * This is the model class for table "menu_top".
 *
 * @property int $id
 * @property string $alias
 * @property string $name
 * @property int $parentId
 * @property int $order
 * @property int $createdAt
 * @property int|null $updatedAt
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class MenuTop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_top';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'name', 'createdAt', 'createdBy', 'updatedBy'], 'required'],
            [['parentId', 'order', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'name'], 'string', 'max' => 255],
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
            'alias' => Yii::t('app', 'Alias'),
            'name' => Yii::t('app', 'Name'),
            'parentId' => Yii::t('app', 'Parent ID'),
            'order' => Yii::t('app', 'Order'),
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
     * @return MenuTopQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuTopQuery(get_called_class());
    }
}
