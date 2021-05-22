<?php
namespace frontend\models;

use Yii;
use yii\helpers\Json;

class Search extends \yii\elasticsearch\ActiveRecord
{
    // public function rules()
    // {
    //     return [
    //         [['name', 'email'], 'safe']
    //     ];
    // }

    // public function attributes()
    // {
    //     return['name', 'email'];
    // }

    //constructioncompany
    // DB name
    public static function index()
    {
        return 'constructioncompany';
    }

    // Table name
    public static function type()
    {
        return 'blog_article';
    }

    public function attributes()
    {
        return ['id', 'title', 'content'];
    }

    public function rules()
    {
        return [
            [$this->attributes(), 'safe']
        ];
    }

    public static function mapping()
    {
        return [
            static::type() =>
            [
                'properties' => [
                    'id' => ['type' => 'long'],
                    'title' => ['type' => 'text'],
                    'content' => ['type' => 'text'],
                ]
            ],
        ];
    }

    // Fill in by common/models/Post model
    public function fill($model, $setPrimaryKey = true) {
        if($setPrimaryKey)
            $this->primaryKey = $model->id;
        $this->attributes = [
            'title' => $model->header1,
            'content'  => $model->text,
        ];
    }

    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            //'aliases' => [ /* ... */ ],
            'mappings' => static::mapping(),
            //'settings' => [ /* ... */ ],
        ]);
    }

//     public static function createIndex()
//     {
//         $db = static::getDb();
//         $command = $db->createCommand();
//         if($command->indexExists(static::index()))
//             $command->deleteIndex(static::index());
//         $command->createIndex(static::index(), [
//             'settings' => [
//                 'analysis' => [
//                     'filter' => [
//                         'ru_stop' => [
//                             'type' => 'stop',
//                             'stopwords' => '_russian_',
//                         ],
//                         'ru_stemmer' => [
//                             'type' => 'stemmer',
//                             'language' => 'russian',
//                         ],
//                     ],
//                     'analyzer' => [
//                         'default' => [
//                             'char_filter' => [
//                                 'html_strip',
//                             ],
//                             'tokenizer' => 'standard',
//                             'filter' => [
//                                 'lowercase',
//                                 'ru_stop',
//                                 'ru_stemmer',
//                             ],
//                         ],
//                     ],
//                 ],
//             ],

//             'mappings' => static::mapping(),
//         ]);
//     }
}