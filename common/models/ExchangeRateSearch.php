<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExchangeRate;

/**
 * ExchangeRateSearch represents the model behind the search form about `common\models\ExchangeRate`.
 */
class ExchangeRateSearch extends ExchangeRate
{
    public $currencyNameFrom;
    public $currencyNameTo;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'currencyIdFrom', 'currencyIdTo', 'created_at', 'updated_at'], 'integer'],
            [['sellValue', 'buyValue'], 'number'],
            [['description'], 'safe'],
            [['currencyNameFrom'], 'safe'],
            [['currencyNameTo'], 'safe'],
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
        $query = ExchangeRate::find();
        $query->joinWith(['currencyFrom']);
        $query->joinWith(['currencyTo']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'description',
                'sellValue',
                'buyValue',
                'currencyNameFrom' => [
                    'asc' => ['cf.name' => SORT_ASC],
                    'desc' => ['cf.name' => SORT_DESC],
                    'label' => 'De'
                ],
                'currencyNameTo' => [
                    'asc' => ['ct.name' => SORT_ASC],
                    'desc' => ['ct.name' => SORT_DESC],
                    'label' => 'A'
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
            'currencyIdFrom' => $this->currencyIdFrom,
            'currencyIdTo' => $this->currencyIdTo,
            'sellValue' => $this->sellValue,
            'buyValue' => $this->buyValue,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);
        
        // filter by currency name
        $query->joinWith(['currencyFrom' => function ($q) {
            $q->where('cf.name LIKE "%' . $this->currencyNameFrom . '%"');
        }]);
        
        // filter by currency name
        $query->joinWith(['currencyTo' => function ($q) {
            $q->where('ct.name LIKE "%' . $this->currencyNameTo . '%"');
        }]);

        return $dataProvider;
    }
}
