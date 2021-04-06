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
    const ACTIVE_STATUS = 1;
    const DISABLED_STATUS = 0;
    
    public static $statusesName = [
        self::ACTIVE_STATUS => 'Активен',
        self::DISABLED_STATUS => 'Отключен',
    ];
    
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
            [['title', 'data', 'icon1', 'icon2', 'status'], 'required'],
            [['data', 'icon1', 'icon2'], 'string'],
            [['sortOrder', 'status', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updatedBy' => 'id']],
            ['sortOrder', 'default', 'value' => 1],
            [['createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'safe'],
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
            'data' => Yii::t('app', 'Data (contacts each with a new line)'),
            'icon1' => Yii::t('app', 'Icon1(big)'),
            'icon2' => Yii::t('app', 'Icon2(little)'),
            'sortOrder' => Yii::t('app', 'Sort Order'),
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
            
            'attribute' => [
                'class' => AttributesBehavior::class,
                'attributes' => [
                    //Phone numbers or email or ...
                    'data' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => [$this, 'makeContacts'],//$this->owner->$attribute
                        ActiveRecord::EVENT_BEFORE_UPDATE  => [$this, 'makeContacts']
                    ],
                    
                    
                ],
            ],
            
        ];
    }

    public function makeContacts($event, $attribute)
    {
        if(!empty($this->$attribute)){
            $a = preg_split("/\r\n|\n|\r/", $this->$attribute);
            $this->$attribute = Json::encode($a);
            return $this->$attribute;
        }
    }

    public function beforeSave($insert)
    {
        // var_dump($this->data);die;
        if($this->isNewRecord)
        {           
            
        }else{
            
        }
        return parent::beforeSave($insert);
    }

    public function afterFind(){

        parent::afterFind();
    
        $this->data = $this->getDecodeData();
    }

    public function getDecodeData()
    {
        $data = Json::decode($this->data);
        // var_dump(implode(PHP_EOL, $data));die;
        return implode(PHP_EOL, $data);
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
     * @return ContactsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactsQuery(get_called_class());
    }
}
