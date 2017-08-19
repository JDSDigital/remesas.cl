<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gtransactions".
 *
 * @property integer $id
 * @property integer $clientId
 * @property integer $accountClientId
 * @property integer $accountAdminId
 * @property double $amountFrom
 * @property double $amountTo
 * @property integer $exchangeId
 * @property integer $userId
 * @property integer $clientBankTransaction
 * @property integer $adminBankTransaction
 * @property string $observation
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AccountAdmin $accountAdmin
 * @property AccountClient $accountClient
 * @property Client $client
 * @property ExchangeRate $exchangeRate
 * @property User $user
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gtransactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'accountClientId', 'amountFrom', 'status'], 'required'],
            [['clientId', 'accountClientId', 'accountAdminId', 'exchangeId', 'userId', 'clientBankTransaction', 'adminBankTransaction', 'status', 'created_at', 'updated_at'], 'integer'],
            [['amountFrom', 'amountTo'], 'number'],
            [['observation'], 'string', 'max' => 255],
            [['accountAdminId'], 'exist', 'skipOnError' => true, 'targetClass' => AccountAdmin::className(), 'targetAttribute' => ['accountAdminId' => 'id']],
            [['accountClientId'], 'exist', 'skipOnError' => true, 'targetClass' => AccountClient::className(), 'targetAttribute' => ['accountClientId' => 'id']],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['clientId' => 'id']],
            [['exchangeId'], 'exist', 'skipOnError' => true, 'targetClass' => ExchangeRate::className(), 'targetAttribute' => ['exchangeId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
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
            'accountClientId' => 'Account Client ID',
            'accountAdminId' => 'Account Admin ID',
            'amountFrom' => 'Amount From',
            'amountTo' => 'Amount To',
            'exchangeId' => 'Exchange ID',
            'userId' => 'User ID',
            'clientBankTransaction' => 'Client Bank Transaction',
            'adminBankTransaction' => 'Admin Bank Transaction',
            'observation' => 'Observation',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAdmin()
    {
        return $this->hasOne(AccountAdmin::className(), ['id' => 'accountAdminId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountClient()
    {
        return $this->hasOne(AccountClient::className(), ['id' => 'accountClientId']);
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
    public function getExchangeRate()
    {
        return $this->hasOne(ExchangeRate::className(), ['id' => 'exchangeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
