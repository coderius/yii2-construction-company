<?php

/**
 * @package myblog
 * @file StringHelper.php created 14.02.2018 14:58:55
 * 
 * @copyright Copyright (C) 2018 Sergio Codev <codev>
 * @license This program is free software: GNU General Public License
 */
namespace common\components\helpers;

use yii\helpers\StringHelper;
use yii;
/**
 * Description of StringHelper
 *
 * @author Sergio Codev <codev>
 */
class CustomStringHelper extends StringHelper{
    
    public static function localeDataFormat($datetime, $pattern = 'php:d F (D.) Yг. в Hч.iм.'){
        return \Yii::$app->formatter->asDateTime($datetime, $pattern);
    }

    /**
     * 
     * @param string $mask
     * @param array $params
     * @return string
     * $subject is strinfg like ''@img-web-blog-posts/%id%/big/%alias%'
     * $params - is a vars wich needed values like [alias => 'some_alias']
     * 
     * What is it for.
     * In params.php set streeng path to img. Example: 'srcImgArticleBig' => '@img-web-blog-posts/%id_article%/big/%src%',
     * 
     * Use in view like this:
     * Html::img(CustomStringHelper::buildSrc(
     *                       Yii::$app->params['srcImgArticleBig'],
     *                       [   'id_article' => $id,//123
     *                           'src' => $srcImg // name.jpg
     *                       ]
     *               ));
     */
    public static function buildSrc($subject, $params = [])
    {
        $search = [];
        $replace = [];
        
        foreach($params as $key => $value){
            $search[] = "%{$key}%";
            $replace[] = $value;
        }
        
        return str_replace($search, $replace, $subject);
    }
    
    /**
     * 
     * @param type $string
     * @param type $length
     * @param type $suffix
     * @param type $lastWorld
     * @param type $encoding
     * @param type $asHtml
     * @return type
     * 
     * Add param $lastWorld . If it is set to true, in the end a whole word is returned 
     */
    public static function truncate($string, $length, $suffix = '...',$lastWorld = true, $encoding = null, $asHtml = false)
    {
        $string = strip_tags($string);
        
        if ($encoding === null) {
            $encoding = Yii::$app ? Yii::$app->charset : 'UTF-8';
        }
        if ($asHtml) {
            return static::truncateHtml($string, $length, $suffix, $encoding);
        }

        if (mb_strlen($string, $encoding) > $length) {
            
            if($lastWorld){
                $length = strpos($string, ' ', $length);
            }
            
            return rtrim(mb_substr($string, 0, $length, $encoding)) . $suffix;
           
        }

        return $string;

    }
//    
//    public static function searchString($haystack, $string, $suffix = '...',$left = 25, $right = 25){
//        $encoding = Yii::$app ? Yii::$app->charset : 'UTF-8';
//        $result = '';
//        $haystackLenght = mb_strlen($haystack, $encoding);
//        $string = $string[0];
//        $strPos = mb_stripos($haystack, $string, 0, $encoding);
//        $strLenght = mb_strlen($string, $encoding);
//        $start;
//        $end;
//        $lSuffix = '';
//        $rSuffix = '';
////        var_dump($fullStrPos);
//        if($strPos !== false){
//            
//            if(($strPos - $left) > 0){
//                $start = ($strPos - $left);
//                $lSuffix = $suffix;
//            }else{
//                $start = 0;
//            }
//            
//            if(($strPos + $strLenght + $right) > $haystackLenght){
//                $end = $haystackLenght;
//            }else{
//                $end = ($strPos + $strLenght + $right);
//                $rSuffix = $suffix;
//            }
//            
////            $resStr = (mb_substr($haystack, $start, $end, $encoding));
//        
//        
////            $allLenght = $left + $right + $strLenght;
////            $difference = $allLenght - $resStr;
////
////            if($difference > 0){
////                if($start > 0){
////                    if(($start - $difference) >= 0){
////                        $start = ($start - $difference);
////                        $difference = 0;
////                    }else{
////                        $start = 0;
////                        $difference = $difference - $start;
////                    }
////                }
////
////                if($end < $haystackLenght){
////                    if(($end + $difference) >= $haystackLenght){
////                        $end = $haystackLenght;
////                        $difference = 0;
////                    }else{
////                        $end = ($end + $difference);
////                        $difference = 0;
////                    }
////                }
////            }
//            
//            $resStr = (mb_substr($haystack, $start, $end-$start, $encoding));
//            var_dump(($string));
//            var_dump(mb_stripos($haystack, $string, 0, $encoding));
//            var_dump(($end));
//            var_dump(($end-$start));
//            $result = $lSuffix . $resStr . $rSuffix;
//        }
//            
//        return !empty($result) ? $result : false;
//        
//    }
    
    
    /**
     * 
     * @param string $text
     * @param array $searchWords
     * @param type $suffix
     * @param int $left
     * @param int $right
     * @param int $maxLengthSnippet - макс. кол-во символов в конечном сниппете
     */
    public static function searchTextDecor($text, $searchWords, $suffix = '...',$left = 25, $right = 25, $maxLengthSnippet = 260, $displayFullWords = true) {
        
        if(!is_array($searchWords) || !is_string($text)){
            return false;
        }
        
        $text = strip_tags($text);
        
        $search = implode("|", $searchWords);
        
        //Если нужно чтобы по заданным кол-вам символов справа и слева прирывались
        //только целые слова, а не куски, то $displayFullWords = true
        if($displayFullWords){
            $exp = "/(?<=\W)(\b.{0,{$left}}\b)({$search})(.{0,{$right}})(?=\W)/ius";
        }else{
            $exp = "/(.{0,{$left}}?)({$search})(.{0,{$right}})/ius";
        }
        
        $result = preg_match_all($exp, $text, $found);
        
//        var_dump($found[0]);

        $count = count($found[0]);
        $snippet = '';
        $x = 1;
        
        foreach($found[0] as  $f){
            if( $x < $count){
                $snippet .= $suffix;
            }
            $snippet .= $f;
            $snippet .= $suffix;
            $snippet .= " ";
            
            $x++;
        }
        
        $snippet = self::neededLengthSnippet($snippet, $maxLengthSnippet, $suffix);
        
        $replacement = '<strong class="line-search-result">$1</strong>';
        $snippet = (preg_replace("/({$search})/ius", $replacement, $snippet));
        
        $encoding = Yii::$app ? Yii::$app->charset : 'UTF-8';
        
        return $result ? $snippet : self::truncate($text, $maxLengthSnippet);
        
    }
    
    //подсветка нужных слов
    public static function illumination($search, $snippet, $cssClass = "line-search-result"){
        if(is_array($search)){
            $search = implode("|", $search);
        }
        
        
        
        $replacement = "<strong class='{$cssClass}'>$1</strong>";
        return (preg_replace("/({$search})/ius", $replacement, $snippet));
    }
    
    
    //сниппет нужной длинны
    public static function neededLengthSnippet($string, $length, $suffix = '...',$lastWorld = true){
        
        if(!is_string($string)){
            return false;
        }
        
        //обрезаем текст по заданной длинне 
        if($lastWorld){
            //вконце целое слово
            $pattern = "/(^.{0,{$length}})(?!\w)(.*)/ius";
        }else{
            //вконце любой символ, может быть не законченное слово
            $pattern = "/(^.{0,{$length}})(.*)/ius";
        }
        
//        (^.{0,20})(?!\w)(?<!\.)\.*(?!\.)
        
        $replacement = "$1";
        $snippet = (preg_replace($pattern, $replacement, $string));
//        var_dump($snippet);
        return rtrim($snippet, ". "). "...";//удаляем лишние троеточия вконце
        
    }
    
}
