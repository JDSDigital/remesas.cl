<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gexchange_rates".
 *
 * @property integer $id
 * @property integer $currencyIdFrom
 * @property integer $currencyIdTo
 * @property double $value
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Currency $currencyFrom
 * @property Currency $currencyTo
 * @property Transaction[] $transactions
 */
class ExchangeRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gexchange_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currencyIdFrom', 'currencyIdTo', 'sellValue', 'buyValue'], 'required'],
            [['currencyIdFrom', 'currencyIdTo', 'created_at', 'updated_at'], 'integer'],
            [['sellValue', 'buyValue'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['currencyIdFrom'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currencyIdFrom' => 'id']],
            [['currencyIdTo'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currencyIdTo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currencyNameFrom' => 'Currency Name From',
            'currencyNameTo' => 'Currency Name To',
            'sellValue' => 'Sell Value',
            'buyValue' => 'Buy Value',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyFrom()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currencyIdFrom'])
                    ->from(Currency::tableName() . ' cf');
    }
    
    /* Getter for currency from name */
    public function getCurrencyNameFrom() {
        return $this->currencyFrom->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyTo()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currencyIdTo'])
                    ->from(Currency::tableName() . ' ct');
    }
    
    /* Getter for currency to name */
    public function getCurrencyNameTo() {
        return $this->currencyTo->name;
    }

    /**
     * Get the exchange rate according to the From and To currencies
     */
    public function getExchangeRateByCurrencies(){
        return ExchangeRate::find()->where(['and', ['currencyIdFrom' => $this->currencyIdFrom], ['currencyIdTo' => $this->currencyIdTo]])->one();
    }
}
