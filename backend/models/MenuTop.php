<?php

namespace backend\models;

use Yii;
use common\models\user\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\AttributesBehavior;

/**
 * This is the model class for table "menu_top".
 *
 * @property int $id
 * @property string $alias
 * @property string $name
 * @property int $parentId
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
class MenuTop extends \yii\db\ActiveRecord
{
    const ACTIVE_STATUS = 1;
    const DISABLED_STATUS = 0;
    
    public static $statusesName = [
        self::ACTIVE_STATUS => 'Активен',
        self::DISABLED_STATUS => 'Отключен',
    ];
    
    // Parent menu items
    public $parentItem = [];

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
            [['alias', 'name', 'status'], 'required'],
            [['parentId', 'sortOrder', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'name'], 'string', 'max' => 255],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updatedBy' => 'id']],
            ['sortOrder', 'default', 'value' => 1],
            ['parentId', 'default', 'value' => 0],
            [['createdAt', 'updatedAt', 'createdBy', 'updatedBy', 'parentItem'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias to needed page'),
            'name' => Yii::t('app', 'Name'),
            'parentId' => Yii::t('app', 'Parent ID'),
            'sortOrder' => Yii::t('app', 'Order in adjacent pages'),
            'status' => Yii::t('app', 'Status'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],

                ],
                'value' => function(){
                    return time();
                },
            //'value' => new \yii\db\Expression('NOW()'),

            ],
            
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => 'updatedBy',
            ],
            // 'attribute' => [
            //     'class' => AttributesBehavior::class,
            //     'attributes' => [
            //         'parentId' => [
            //             ActiveRecord::EVENT_BEFORE_INSERT => [$this, 'makeParentId'],//$this->owner->$attribute
            //             ActiveRecord::EVENT_BEFORE_UPDATE  => [$this, 'makeParentId']
            //         ],

            //     ],
            // ],
        ];
    }

    

    public function selectParentId($self = false)
    {
        $ar = ArrayHelper::map(MenuTop::find()->all(), 'id', 'name');
        if(!$this->isNewRecord && $self === false){
            ArrayHelper::remove($ar, $this->id);
        }

        return $ar;
    }

    public function getParentItem()
    {
        return self::findOne($this->parentId);
    }


    /**
     * Gets query for [[CreatedBy0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(User::class, ['id' => 'createdBy']);
    }

    /**
     * Gets query for [[UpdatedBy0]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdatedBy0()
    {
        return $this->hasOne(User::class, ['id' => 'updatedBy']);
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
