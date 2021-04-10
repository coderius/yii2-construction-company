<?php

namespace frontend\models\sidebar;

use Yii;
use yii\base\Model;

/**
 * Sidebar
 */
class Sidebar extends Model
{
    public $recentPosts;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[], 'required'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [];
    }

    
    
}
