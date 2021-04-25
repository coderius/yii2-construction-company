<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "widgets".
 *
 * @property int $id
 * @property string $type
 * @property string $descriptions
 */
class Widgets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widgets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'descriptions'], 'required'],
            [['type'], 'string'],
            [['descriptions'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'descriptions' => Yii::t('app', 'Descriptions'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return WidgetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetsQuery(get_called_class());
    }
}
