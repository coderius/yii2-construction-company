<?php

namespace common\components\helpers;

use yii\helpers\Html;
use yii\web\View;

final class InputHelper{

    /**
     * Undocumented function
     *
     * @param [string] $target
     * @param [string] $elem
     * @param [yii\web\View] $view
     * @return void
     */
    public static function inputTranclite($targetId, $elemId, $view)
    {
        $js = <<<JS
var a = {"Ё":"YO","Й":"I","Ц":"TS","У":"U","К":"K","Е":"E","Н":"N","Г":"G","Ш":"SH","Щ":"SCH","З":"Z","Х":"H","Ъ":"'","ё":"yo","й":"i","ц":"ts","у":"u","к":"k","е":"e","н":"n","г":"g","ш":"sh","щ":"sch","з":"z","х":"h","ъ":"'","Ф":"F","Ы":"I","В":"V","А":"a","П":"P","Р":"R","О":"O","Л":"L","Д":"D","Ж":"ZH","Э":"E","ф":"f","ы":"i","в":"v","а":"a","п":"p","р":"r","о":"o","л":"l","д":"d","ж":"zh","э":"e","Я":"Ya","Ч":"CH","С":"S","М":"M","И":"I","Т":"T","Ь":"'","Б":"B","Ю":"YU","я":"ya","ч":"ch","с":"s","м":"m","и":"i","т":"t","ь":"","б":"b","ю":"yu"," ":"-","  ":"-","   ":"-"};
var stop = ['.',',','/','?', 'ь', 'ъ', ':'];
function transliterate(word, toLowerCase = true){
  return word.split('').map(function (char) {
    if(stop.indexOf(char) != -1){
        return;
    }
    var r = a[char] || char;
    return toLowerCase ? r.toLowerCase() : r;
  }).join("");
}

var \$target = document.querySelector('#$targetId');
var \$elem = document.querySelector("#$elemId");
var stopTransleteAlias = false;
\$target.addEventListener('keyup', function hdlr(event){
    if(stopTransleteAlias){
        return;
    }else{
        \$elem.value = transliterate(event.target.value);
    }
    
});


JS;

$view->registerJS(
    $js,
    View::POS_READY,
    'transliterate-input'
);
    }



}