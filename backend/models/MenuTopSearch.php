<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MenuTop;

/**
 * MenuTopSearch represents the model behind the search form of `backend\models\MenuTop`.
 */
class MenuTopSearch extends MenuTop
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parentId', 'order', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'name'], 'safe'],
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
        $query = MenuTop::find();

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
            'parentId' => $this->parentId,
            'order' => $this->order,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
