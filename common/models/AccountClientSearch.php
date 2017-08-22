<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccountClient;

/**
 * AccountClientSearch represents the model behind the search form about `common\models\AccountClient`.
 */
class AccountClientSearch extends AccountClient
{
    public $bankName;
    public $currencyName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clientId', 'bankId', 'currencyId'], 'integer'],
            [['number', 'type', 'description', 'bankName', 'currencyName'], 'safe'],
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
        $query = AccountClient::find();
        $query->joinWith(['bank']);
        $query->joinWith(['currency']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'description',
                'type',
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
            'clientId' => $this->clientId,
            'bankId' => $this->bankId,
            'currencyId' => $this->currencyId,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'description', $this->description]);
            
        $query->joinWith(['bank' => function ($q) {
            $q->where('gbanks.name LIKE "%' . $this->bankName . '%"');
        }]);
        
        $query->joinWith(['currency' => function ($q) {
            $q->where('gcurrencies.name LIKE "%' . $this->currencyName . '%"');
        }]);

        return $dataProvider;
    }
}
