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
    public $bankName;
    public $currencyName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bankId', 'currencyId', 'status'], 'integer'],
            [['minAmount', 'maxAmount'], 'number'],
            [['number', 'type', 'description', 'name', 'lastname', 'rut', 'email', 'bankName', 'currencyName'], 'safe'],
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
        $query->joinWith(['bank']);
        $query->joinWith(['currency']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'defaultOrder' => ['description' => SORT_ASC],
            'attributes' => [
                'id',
                'description',
                'type',
                'maxAmount',
                'minAmount',
                'status',
                'bankName' => [
                    'asc' => ['gbanks.name' => SORT_ASC],
                    'desc' => ['gbanks.name' => SORT_DESC],
                    'label' => 'Banco'
                ],
                'currencyName' => [
                    'asc' => ['gcurrencies.name' => SORT_ASC],
                    'desc' => ['gcurrencies.name' => SORT_DESC],
                    'label' => 'Moneda'
                ]
            ]
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
            
        $query->joinWith(['bank' => function ($q) {
            $q->where('gbanks.name LIKE "%' . $this->bankName . '%"');
        }]);
        
        $query->joinWith(['currency' => function ($q) {
            $q->where('gcurrencies.name LIKE "%' . $this->currencyName . '%"');
        }]);

        return $dataProvider;
    }
}
