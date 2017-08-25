<?php

namespace common\models;

use Yii;

use yii\db\ActiveRecord;

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
 * @property double $exchangeValue
 * @property double $winnings
 * @property integer $status
 * @property integer $transactionDate
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AccountAdmin $accountAdmin
 * @property AccountClient $accountClient
 * @property Client $client
 * @property ExchangeRate $exchangeRate
 * @property User $user
 */
class Transaction extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_CANCELLED = 1;
    const STATUS_DONE = 2;
    
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
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'accountClientId', 'amountFrom', 'exchangeValue', 'transactionDate'], 'required'],
            [['clientId', 'accountClientId', 'accountAdminId', 'exchangeId', 'userId', 'clientBankTransaction', 'adminBankTransaction', 'status', 'created_at', 'updated_at'], 'integer'],
            [['amountFrom', 'amountTo', 'exchangeValue', 'winnings'], 'number'],
            [['observation'], 'string', 'max' => 255],
            [['accountAdminId'], 'exist', 'skipOnError' => true, 'targetClass' => AccountAdmin::className(), 'targetAttribute' => ['accountAdminId' => 'id']],
            [['accountClientId'], 'exist', 'skipOnError' => true, 'targetClass' => AccountClient::className(), 'targetAttribute' => ['accountClientId' => 'id']],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['clientId' => 'id']],
            [['exchangeId'], 'exist', 'skipOnError' => true, 'targetClass' => ExchangeRate::className(), 'targetAttribute' => ['exchangeId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['status', 'in', 'range' => [self::STATUS_PENDING, self::STATUS_CANCELLED, self::STATUS_DONE]],
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
            'exchangeValue' => 'Exchange Value',
            'winnings' => 'Winnings',
            'status' => 'Status',
            'transactionDate' => 'Transaction Date',
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
        return $this->hasOne(AccountClient::className(), ['id' => 'accountClientId'])
                     ->from(AccountClient::tableName() . ' ac');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'clientId'])
                    ->from(Client::tableName() . ' c');
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
