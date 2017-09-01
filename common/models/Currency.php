<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gcurrencies".
 *
 * @property integer $id
 * @property string $name
 * @property string $symbol
 *
 * @property AccountAdmin[] $accountsAdmin
 * @property AccountClient[] $accountsClients
 * @property ExchangeRate[] $exchangeRatesFrom
 * @property ExchangeRate[] $exchangeRatesTo
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gcurrencies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'El nombre del país no puede estar vacío'],
            ['symbol', 'required', 'message' => 'El símbolo de la moneda no puede estar vacío'],
            [['name', 'symbol'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'symbol' => 'Symbol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountsAdmin()
    {
        return $this->hasMany(AccountAdmin::className(), ['currencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountsClients()
    {
        return $this->hasMany(AccountClient::className(), ['currencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangeRatesFrom()
    {
        return $this->hasMany(ExchangeRate::className(), ['currencyIdFrom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangeRatesTo()
    {
        return $this->hasMany(ExchangeRate::className(), ['currencyIdTo' => 'id']);
    }
}
