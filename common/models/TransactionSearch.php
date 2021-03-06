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
    public $exchangeRateDescription;
    public $accountAdminDescFrom;
    //public $clientName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'clientId', 'accountClientId', 'accountAdminIdTo', 'accountAdminIdFrom', 'userId', 'clientBankTransaction', 'adminBankTransaction', 'status', 'transactionDate', 'created_at', 'updated_at', 'currencyIdFrom', 'currencyIdTo', 'exchangeId'], 'integer'],
            [['amountFrom', 'amountTo', 'sellRateValue', 'buyRateValue', 'winnings', 'usedValue'], 'number'],
            [['observation', 'accountClientDescription', 'currencyNameFrom', 'currencyNameTo', 'exchangeRateDescription', 'accountAdminDescFrom'/*, 'clientName'*/], 'safe'],
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
        $query->joinWith(['exchangeRate']);
        $query->joinWith(['accountAdminFrom']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
             ],
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
                ],
                'exchangeRateDescription' => [
                    'asc' => ['gexchange_rates.description' => SORT_ASC],
                    'desc' => ['gexchange_rates.description' => SORT_DESC],
                    'label' => 'Tasa'
                ],
                'accountAdminDescFrom' => [
                    'asc' => ['aaf.description' => SORT_ASC],
                    'desc' => ['aaf.description' => SORT_DESC],
                    'label' => 'Desde la cuenta'
                ],/*,
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
            ],
            'defaultOrder' => [
                'status' => SORT_ASC,
                'id' => SORT_DESC,
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
            'accountAdminIdTo' => $this->accountAdminIdTo,
            'accountAdminIdFrom' => $this->accountAdminIdFrom,
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
        
        $query->joinWith(['exchangeRate' => function ($q) {
            $q->where('gexchange_rates.description LIKE "%' . $this->exchangeRateDescription . '%"');
        }]);
        
        /*$query->joinWith(['accountAdminFrom' => function ($q) {
            $q->where('aaf.description LIKE "%' . $this->accountAdminDescFrom . '%"');
        }]);*/
        
        /*$query->joinWith(['client' => function ($q) {
            $q->where('c.name LIKE "%' . $this->clientName . '%"');
        }]);*/
        
        /*echo $query->createCommand()->getRawSql();
        die();*/

        return $dataProvider;
    }
    
    public function searchReport($params){
        $query = Transaction::find();
        $query->joinWith(['currencyFrom']);
        $query->joinWith(['currencyTo']);
        $query->joinWith(['accountClient']);
        $query->joinWith(['client']);
        $query->joinWith(['exchangeRate']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
             ],
        ]);
        
        $query->andFilterWhere(['>=', 'gtransactions.created_at', $params['startDate']]);
//        $query->andFilterWhere(['<', 'gtransactions.created_at', $params['endDate']+86400]);
        $query->andFilterWhere(['<', 'gtransactions.created_at', $params['endDate']]);

        if ($params['status'] != ""){
            $query->andFilterWhere(['gtransactions.status' => $params['status']]);
        }
        
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
        
        $query->joinWith(['exchangeRate' => function ($q) {
            $q->where('gexchange_rates.description LIKE "%' . $this->exchangeRateDescription . '%"');
        }]);
        
        /*echo  $query->createCommand()->getRawSql();
        die();*/
        return $dataProvider;
    }
}
