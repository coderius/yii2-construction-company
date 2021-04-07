<?php

namespace common\components\helpers;

use yii\helpers\StringHelper;
use yii;


class DateTimeHelper{
    
    public static function localeDataFormat($datetime, $pattern = 'php:d F (D.) Yг. в Hч.iм.'){
        return \Yii::$app->formatter->asDateTime($datetime, $pattern);
    }

}
