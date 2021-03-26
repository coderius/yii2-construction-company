<?php
namespace common\widgets\materialList;

use yii\base\Event; 
/**
 * @package myblog
 * @file WidgetEvent.php created 17.06.2018 12:52:10
 * 
 * @copyright Copyright (C) 2018 Sergio coderius <coderius>
 * @license This program is free software: GNU General Public License
 */

class WidgetEvent extends Event
{
    /**
     * @var mixed the widget result. Event handlers may modify this property to change the widget result.
     */
    public $result;
    
    public $model;
    /*
     * Current index in element
     */
    public $indexElement;
    /**
     * @var bool whether to continue running the widget. Event handlers of
     * [[Widget::EVENT_BEFORE_RUN]] may set this property to decide whether
     * to continue running the current widget.
     */
    public $isValid = true;
    
    
}
