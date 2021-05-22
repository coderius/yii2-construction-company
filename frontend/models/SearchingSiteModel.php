<?php

namespace frontend\models;

use Yii;
use \yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BlogArticle;
use common\components\behaviors\PurifyBehavior;
use yii\behaviors\AttributesBehavior;
use yii\helpers\HtmlPurifier;

class SearchingSiteModel extends Model{

    public $q;
    public $searchWords = [];
    public $countResults;


    public function rules()
    {
        return [
            [['q'], 'filter','filter'=>'trim'],
//            [['q'], 'safe'],
//            [['id', 'rubric_id', 'city_id', 'autorId', 'price', 'valuta_id', 'postal_transfer', 'ads_user_phone', 'brand_id', 'second_hand', 'boutique'], 'integer'],
//            [['status', 'title', 'description', 'createdDate', 'ads_user_email'], 'safe'],
        ];
    }
    
    public function behaviors()
    {
        return [
//            'purify' => [
//                'class' => PurifyBehavior::className(),
//                'attributes' => ['q'],
//            ],
            'attributesBehavior' => [
                'class' => AttributesBehavior::className(),
                'attributes' => [
                    'q' => [
                        self::EVENT_BEFORE_VALIDATE => function ($event, $attribute) {
                            return HtmlPurifier::process(urldecode($this->$attribute));
//                            var_dump($this->$attribute);die;
                        },
                    ],
                ],
            ],
        ];
    }
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BlogArticle::find();

        $cloneQ = clone $query;
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
//                'pageSize' => $pageSize,
                'totalCount' =>  $cloneQ->count(),
            ],
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
//        var_dump($this->q);die;
        if(empty($this->q)){
            $dataProvider->query = new yii\db\Query();
            $dataProvider->setTotalCount(0);
            return $dataProvider;
        }
//        var_dump($dataProvider);
//        $this->searchWords[0] = $this->q;
        
        ////////////////////////////////////////////////////////////////////////
        //ищем целое словосочетание
        
//        $query->andFilterWhere(['like', 'title', $this->searchWords[0]])
//              ->orFilterWhere(['like', 'text', $this->searchWords[0]]);
        
//        $cloneQ = clone $query;
        

        ////////////////////////////////////////////////////////////////////////
        //Если нет в базе с точным вхождением, то делим на отдельные слова 
        //по пробелу
        //и ищем по отдельности
        
//        if(!$cloneQ->count()){
            
            //по отдельным словам, прошлый массив затираем
            $this->searchWords = array_merge($this->searchWords, explode(" ", $this->q));
//            var_dump($this->searchWords);die;
            if(!empty($this->searchWords)){
                foreach ($this->searchWords as $word){
                    $query->orFilterWhere(['like', 'header1', $word]);
                    $query->orFilterWhere(['like', 'text', $word]);
                }
            }
//        }
        
        $case = '';
        
        //подсчет релевантности
        //title - 1 очка, text - 1
        foreach ($this->searchWords as $word){
            $case .= "(CASE WHEN `header1` LIKE '%{$word}%' THEN 2 ELSE 0 END) + (CASE WHEN `text` LIKE '%{$word}%' THEN 1 ELSE 0 END) +";
        }
        
        $case = rtrim($case , "+");
        
        $query->orderBy("{$case} DESC , id DESC");
        
        
        
        $cloneQ = clone $query;
        $this->countResults = $cloneQ->count();
//        $dataProvider->pagination->totalCount = $cloneQ->count();
        
        return $dataProvider;
    }
    
}