<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BlogArticle;

/**
 * BlogArticleSearch represents the model behind the search form of `backend\models\BlogArticle`.
 */
class BlogArticleSearch extends BlogArticle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'viewCount', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'metaTitle', 'metaDesc', 'header1', 'text', 'img'], 'safe'],
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
        $query = BlogArticle::find();

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
            'status' => $this->status,
            'viewCount' => $this->viewCount,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'metaTitle', $this->metaTitle])
            ->andFilterWhere(['like', 'metaDesc', $this->metaDesc])
            ->andFilterWhere(['like', 'header1', $this->header1])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
