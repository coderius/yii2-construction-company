<?php

namespace frontend\models;

use Yii;
use common\models\user\User;
use common\models\UserProfile;

/**
 * This is the model class for table "menu_top".
 *
 * @property int $id
 * @property string $alias
 * @property string $name
 * @property int $parentId
 * @property int $sortOrder
 * @property int $status 	0 - desibled,1-enabled
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
    const ACTIVE_STATUS = 1;
    const DISABLED_STATUS = 0;
    
    public static $statusesName = [
        self::ACTIVE_STATUS => 'Активен',
        self::DISABLED_STATUS => 'Отключен',
    ];

    protected $children;

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
            [['alias', 'name', 'status', 'createdAt', 'createdBy', 'updatedBy'], 'required'],
            [['parentId', 'sortOrder', 'status', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
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
            'sortOrder' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
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

    public static function getTree()
    {
        $models = self::find()->where(['status' => MenuTop::ACTIVE_STATUS])->orderBy(['sortOrder' => SORT_ASC])->all();

        if (!empty($models)) {
            $models = static::buildTree($models);
        }

        return $models;
    }


    protected static function buildTree(&$data, $rootID = 0)
    {
        $tree = [];

        foreach ($data as $id => $node) {
            if ($node->parentId == $rootID) {
                unset($data[$id]);
                $node->children = self::buildTree($data, $node->id);
                $tree[] = $node;
            }
        }

        return $tree;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function hasChildren()
    {
        return !empty($this->children);
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
