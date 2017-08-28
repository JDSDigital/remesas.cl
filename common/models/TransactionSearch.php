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
    public $currencyNameFrom;
    public $currencyNameTo;
    public $accountClientDescription;
    //public $clientName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clientId', 'accountClientId', 'accountAdminId', 'userId', 'clientBankTransaction', 'adminBankTransaction', 'status', 'transactionDate', 'created_at', 'updated_at', 'currencyIdFrom', 'currencyIdTo'], 'integer'],
            [['amountFrom', 'amountTo', 'sellRateValue', 'buyRateValue', 'winnings', 'usedValue'], 'number'],
            [['observation', 'accountClientDescription', 'currencyNameFrom', 'currencyNameTo'/*, 'clientName'*/], 'safe'],
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
        $query->joinWith(['currencyFrom']);
        $query->joinWith(['currencyTo']);
        $query->joinWith(['accountClient']);
        $query->joinWith(['client']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'created_at',
                'amountFrom',
                'sellRateValue',
                'buyRateValue',
                'usedValue',
                'amountTo',
                'clientBankTransaction',
                'transactionDate',
                'status',
                'currencyIdFrom',
                'currencyIdTo',
                'accountClientDescription' => [
                    'asc' => ['ac.description' => SORT_ASC],
                    'desc' => ['ac.description' => SORT_DESC],
                    'label' => 'Cuenta'
                ],
                'currencyNameFrom' => [
                    'asc' => ['cf.name' => SORT_ASC],
                    'desc' => ['cf.name' => SORT_DESC],
                    'label' => 'De'
                ],
                'currencyNameTo' => [
                    'asc' => ['ct.name' => SORT_ASC],
                    'desc' => ['ct.name' => SORT_DESC],
                    'label' => 'A'
                ]/*,
                'clientName' => [
                    'asc' => ['c.name' => SORT_ASC],
                    'desc' => ['c.name' => SORT_DESC],
                    'label' => 'Nombre del Cliente'
                ],
                'clientLastName' => [
                    'asc' => ['c.lastName' => SORT_ASC],
                    'desc' => ['c.lastName' => SORT_DESC],
                    'label' => 'Apellido del Cliente'
                ],*/
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
            'currencyIdFrom' => $this->currencyIdFrom,
            'currencyIdTo' => $this->currencyIdTo,
            'userId' => $this->userId,
            'clientBankTransaction' => $this->clientBankTransaction,
            'adminBankTransaction' => $this->adminBankTransaction,
            'sellRateValue' => $this->sellRateValue,
            'buyRateValue' => $this->buyRateValue,
            'usedValue' => $this->usedValue,
            'winnings' => $this->winnings,
            'status' => $this->status,
            'transactionDate' => $this->transactionDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'observation', $this->observation]);
        
        $query->joinWith(['accountClient' => function ($q) {
            $q->where('ac.description LIKE "%' . $this->accountClientDescription . '%"');
        }]);
        
        // filter by currency name
        $query->joinWith(['currencyFrom' => function ($q) {
            $q->where('cf.name LIKE "%' . $this->currencyNameFrom . '%"');
        }]);
        
        // filter by currency name
        $query->joinWith(['currencyTo' => function ($q) {
            $q->where('ct.name LIKE "%' . $this->currencyNameTo . '%"');
        }]);
        
        /*$query->joinWith(['client' => function ($q) {
            $q->where('c.name LIKE "%' . $this->clientName . '%"');
        }]);*/

        return $dataProvider;
    }
}
