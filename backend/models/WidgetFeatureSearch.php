<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WidgetFeature;

/**
 * WidgetFeatureSearch represents the model behind the search form of `backend\models\WidgetFeature`.
 */
class WidgetFeatureSearch extends WidgetFeature
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'widgetId', 'sortOrder'], 'integer'],
            [['icon', 'header', 'text'], 'safe'],
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
        $query = WidgetFeature::find();

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
            'widgetId' => $this->widgetId,
            'sortOrder' => $this->sortOrder,
        ]);

        $query->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
