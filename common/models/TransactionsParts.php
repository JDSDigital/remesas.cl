<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gtransactions_parts".
 *
 * @property integer $id
 * @property integer $transactionId
 * @property integer $accountAdminIdFrom
 * @property integer $adminBankTransaction
 * @property string $transactionResponseDate
 *
 * @property AccountAdmin $accountAdminFrom
 * @property Transaction $transaction
 */
class TransactionsParts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gtransactions_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['accountAdminIdFrom', 'required', 'message' => 'Debe indicar la cuenta desde donde se realizó transferencia.'],
            ['adminBankTransaction', 'required', 'message' => 'Debe escribir el número de la transferencia.'],
            ['transactionResponseDate', 'required', 'message' => 'Debe indicar la fecha de la transferencia.'],
//            ['transactionResponseDate', 'default', 'value' => date('Y-m-d')],
            ['amountTo', 'required', 'message' => 'Debe indicar el monto de la transferencia.'],
            [['transactionId', 'accountAdminIdFrom', 'adminBankTransaction'], 'integer'],
            [['transactionResponseDate'], 'safe'],
            [['transactionId'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['transactionId' => 'id']],
            [['accountAdminIdFrom'], 'exist', 'skipOnError' => true, 'targetClass' => AccountAdmin::className(), 'targetAttribute' => ['accountAdminIdFrom' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transactionId' => 'Transaction ID',
            'accountAdminIdFrom' => 'Account Admin Id From',
            'adminBankTransaction' => 'Admin Bank Transaction',
            'transactionResponseDate' => 'Transaction Response Date',
            'amountTo' => 'Amount To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'transactionId']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAdminFrom()
    {
        return $this->hasOne(AccountAdmin::className(), ['id' => 'accountAdminIdFrom']);
    }
}
