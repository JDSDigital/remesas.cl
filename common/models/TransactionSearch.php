<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form about `common\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    public $exchangeRateDescription;
    public $accountClientDescription;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clientId', 'accountClientId', 'accountAdminId', 'exchangeId', 'userId', 'clientBankTransaction', 'adminBankTransaction', 'status', 'transactionDate', 'created_at', 'updated_at'], 'integer'],
            [['amountFrom', 'amountTo', 'exchangeValue', 'winnings'], 'number'],
            [['observation', 'exchangeRateDescription', 'accountClientDescription'], 'safe'],
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
        $query = Transaction::find();
        $query->joinWith(['exchangeRate']);
        $query->joinWith(['accountClient']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'created_at',
                'amountFrom',
                'exchangeValue',
                'amountTo',
                'clientBankTransaction',
                'transactionDate',
                'status',
                'exchangeRateDescription' => [
                    'asc' => ['gexchange_rates.description' => SORT_ASC],
                    'desc' => ['gexchange_rates.description' => SORT_DESC],
                    'label' => 'Tasa'
                ],
                'accountClientDescription' => [
                    'asc' => ['gaccount_client.description' => SORT_ASC],
                    'desc' => ['gaccount_client.description' => SORT_DESC],
                    'label' => 'Cuenta'
                ],
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
            'accountClientId' => $this->accountClientId,
            'accountAdminId' => $this->accountAdminId,
            'amountFrom' => $this->amountFrom,
            'amountTo' => $this->amountTo,
            'exchangeId' => $this->exchangeId,
            'userId' => $this->userId,
            'clientBankTransaction' => $this->clientBankTransaction,
            'adminBankTransaction' => $this->adminBankTransaction,
            'exchangeValue' => $this->exchangeValue,
            'winnings' => $this->winnings,
            'status' => $this->status,
            'transactionDate' => $this->transactionDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'observation', $this->observation]);
        
        $query->joinWith(['exchangeRate' => function ($q) {
            $q->where('gexchange_rates.description LIKE "%' . $this->exchangeRateDescription . '%"');
        }]);
        
        $query->joinWith(['accountClient' => function ($q) {
            $q->where('gaccounts_clients.description LIKE "%' . $this->accountClientDescription . '%"');
        }]);

        return $dataProvider;
    }
}
