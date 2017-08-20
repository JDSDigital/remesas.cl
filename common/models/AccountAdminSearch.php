<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccountAdmin;

/**
 * AccountAdminSearch represents the model behind the search form about `common\models\AccountAdmin`.
 */
class AccountAdminSearch extends AccountAdmin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bankId', 'minAmount', 'maxAmount', 'currencyId', 'status'], 'integer'],
            [['number', 'type', 'description', 'name', 'lastname', 'rut', 'email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = AccountAdmin::find();

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
            'bankId' => $this->bankId,
            'minAmount' => $this->minAmount,
            'maxAmount' => $this->maxAmount,
            'currencyId' => $this->currencyId,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'rut', $this->rut])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
