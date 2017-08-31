<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Bank;

/**
 * BankSearch represents the model behind the search form about `common\models\Bank`.
 */
class BankSearch extends Bank
{
    public $countryName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'countryId'], 'integer'],
            [['name'], 'safe'],
            [['countryName'], 'safe'],
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
        $query = Bank::find();
        $query->joinWith(['country']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => ['name' => SORT_ASC], 
            'attributes' => [
                'id',
                'name',
                'countryName' => [
                    'asc' => ['gcountries.name' => SORT_ASC],
                    'desc' => ['gcountries.name' => SORT_DESC],
                    'label' => 'Pais'
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
            'countryId' => $this->countryId,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        
        // filter by country name
        $query->joinWith(['country' => function ($q) {
            $q->where('gcountries.name LIKE "%' . $this->countryName . '%"');
        }]);

        return $dataProvider;
    }
}
?>