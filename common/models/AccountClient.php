<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gaccounts_clients".
 *
 * @property integer $id
 * @property integer $clientId
 * @property integer $bankId
 * @property string $number
 * @property string $type
 * @property integer $currencyId
 *
 * @property Bank $bank
 * @property Client $client
 * @property Currency $currency
 * @property Transaction[] $transactions
 */
class AccountClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gaccounts_clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'bankId', 'number', 'type', 'currencyId'], 'required'],
            [['clientId', 'bankId', 'currencyId'], 'integer'],
            [['number', 'type'], 'string', 'max' => 255],
            [['bankId'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::className(), 'targetAttribute' => ['bankId' => 'id']],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['clientId' => 'id']],
            [['currencyId'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currencyId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clientId' => 'Client ID',
            'bankId' => 'Bank ID',
            'number' => 'Number',
            'type' => 'Type',
            'currencyId' => 'Currency ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['id' => 'bankId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'clientId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['accountClientId' => 'id']);
    }
}
