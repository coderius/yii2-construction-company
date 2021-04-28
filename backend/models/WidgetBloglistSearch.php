<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WidgetBloglist;

/**
 * WidgetBloglistSearch represents the model behind the search form of `backend\models\WidgetBloglist`.
 */
class WidgetBloglistSearch extends WidgetBloglist
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'widgetId'], 'integer'],
            [['typeContent'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
        $query = WidgetBloglist::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'widgetId' => $this->widgetId,
        ]);

        $query->andFilterWhere(['like', 'typeContent', $this->typeContent]);

        return $dataProvider;
    }
}
