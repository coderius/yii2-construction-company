<?php

namespace frontend\models;

use Yii;

interface TypableBlogInterface{

    public function getContentType();

    public function getBlogList();

}