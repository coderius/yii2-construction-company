<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WidgetCarousel;

/**
 * WidgetCarouselSearch represents the model behind the search form of `backend\models\WidgetCarousel`.
 */
class WidgetCarouselSearch extends WidgetCarousel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['header1', 'header2', 'buttonTitle', 'buttonLink', 'img', 'imgAlt'], 'safe'],
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
        $query = WidgetCarousel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'sortOrder' => SORT_ASC,
                ]
            ],
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
        ]);

        $query->andFilterWhere(['like', 'header1', $this->header1])
            ->andFilterWhere(['like', 'header2', $this->header2])
            ->andFilterWhere(['like', 'buttonTitle', $this->buttonTitle])
            ->andFilterWhere(['like', 'buttonLink', $this->buttonLink])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'imgAlt', $this->imgAlt]);

        return $dataProvider;
    }
}
