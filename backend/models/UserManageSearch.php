<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserManage;

/**
 * UserManageSearch represents the model behind the search form of `backend\models\UserManage`.
 */
class UserManageSearch extends UserManage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'createdAt', 'updatedAt'], 'integer'],
            [['role', 'username', 'authKey', 'password', 'passwordResetToken', 'email', 'verificationToken'], 'safe'],
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
        $query = UserManage::find();

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
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'authKey', $this->authKey])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'passwordResetToken', $this->passwordResetToken])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'verificationToken', $this->verificationToken]);

        return $dataProvider;
    }
}
