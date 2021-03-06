<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PortfolioCategory;

/**
 * PortfolioCategorySearch represents the model behind the search form of `backend\models\PortfolioCategory`.
 */
class PortfolioCategorySearch extends PortfolioCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sortOrder', 'status', 'viewCount', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy'], 'integer'],
            [['alias', 'metaTitle', 'metaDesc', 'headerShort', 'headerLong', 'frontId'], 'safe'],
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
    public function search($params, $alias = null, $type = null)
    {
        $query = PortfolioCategory::find()->where([self::tableName().".status" => self::ACTIVE_STATUS]);

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

        //Join with image in category marked like front image for this category
        $query->joinWith([
            'front' => function ($query) {
                $query->select(['id', 'img', 'imgAlt']);
            },
            'createdBy0' => function ($query) {
                $query->select(['id', 'username']);
            }
        ]);

        if($alias && $type === "tag"){
            $query->joinWith('tags');
            $query->andWhere(['tag.alias' => $alias]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sortOrder' => $this->sortOrder,
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
            ->andFilterWhere(['like', 'headerShort', $this->headerShort])
            ->andFilterWhere(['like', 'headerLong', $this->headerLong]);

        return $dataProvider;
    }

    //Not used. Dug
    public function searchInCategory($params, $alias)
    {
        $query = PortfolioCategory::find()->where([self::tableName().".alias" => $alias]);

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

        //Join with image in category marked like front image for this category
        $query->joinWith([
            'category c'
        ]);
        $query->where(["c.alias" => $alias]);
        // if($alias && $type === "tag"){
        //     $query->joinWith('tags');
        //     $query->andWhere(['tag.alias' => $alias]);
        // }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sortOrder' => $this->sortOrder,
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
            ->andFilterWhere(['like', 'headerShort', $this->headerShort])
            ->andFilterWhere(['like', 'headerLong', $this->headerLong]);

        return $dataProvider;
    }
}