<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BlogArticle;

/**
 * BlogCategorySearch represents the model behind the search form of `frontend\models\BlogArticle`.
 */
class BlogArticleSearch extends BlogArticle
{
    // public $category;
    // public $author;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'viewCount', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'metaTitle', 'metaDesc', 'header1', 'text', 'img', 'imgAlt'], 'safe'],
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
        $query = BlogArticle::find()->active();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => new \yii\data\Pagination(
                [
                    'forcePageParam' => false,
                    'pageSizeParam' => false,
                    'pageParam' => 'pageNum',
                    
                ]
            ),
            
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->with([
            'createdBy0' => function ($query) {
                $query->select(['id', 'username']);
            }
            ,
            'category' => function ($query) {
                $query->select(['id', 'header', 'alias']);
            }
        ]);

        $dataProvider->setSort(['defaultOrder' => ['createdAt'=> SORT_DESC]]);

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
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'imgAlt', $this->imgAlt]);

        return $dataProvider;
    }
}