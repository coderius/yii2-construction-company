<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "page_widgets".
 *
 * @property int $id
 * @property int $pageId
 * @property string $template
 *
 * @property Page $page
 */
class PageWidgets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_widgets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pageId', 'template'], 'required'],
            [['pageId'], 'integer'],
            [['template'], 'string'],
            [['pageId'], 'unique'],
            [['pageId'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['pageId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pageId' => Yii::t('app', 'Page ID'),
            'template' => Yii::t('app', 'Template'),
        ];
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery|PageQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'pageId']);
    }

    /**
     * {@inheritdoc}
     * @return PageWidgetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageWidgetsQuery(get_called_class());
    }
}
