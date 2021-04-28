<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WidgetTestimonial;

/**
 * WidgetTestimonialSearch represents the model behind the search form of `backend\models\WidgetTestimonial`.
 */
class WidgetTestimonialSearch extends WidgetTestimonial
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'widgetId', 'sortOrder'], 'integer'],
            [['img', 'header1', 'header2', 'text'], 'safe'],
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
        $query = WidgetTestimonial::find();

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
            'sortOrder' => $this->sortOrder,
        ]);

        $query->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'header1', $this->header1])
            ->andFilterWhere(['like', 'header2', $this->header2])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
