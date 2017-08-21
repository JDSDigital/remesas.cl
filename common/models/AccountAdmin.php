<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gaccounts_admin".
 *
 * @property integer $id
 * @property integer $bankId
 * @property string $number
 * @property string $type
 * @property string $description
 * @property string $name
 * @property string $lastname
 * @property string $rut
 * @property string $email
 * @property integer $minAmount
 * @property integer $maxAmount
 * @property integer $currencyId
 * @property integer $status
 *
 * @property Bank $bank
 * @property Currency $currency
 * @property Transaction[] $transactions
 */
class AccountAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gaccounts_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bankId', 'number', 'type', 'description', 'name', 'lastname', 'rut', 'email', 'minAmount', 'maxAmount', 'currencyId'], 'required'],
            [['bankId', 'minAmount', 'maxAmount', 'currencyId', 'status'], 'integer'],
            [['number', 'type', 'description', 'name', 'lastname', 'rut', 'email'], 'string', 'max' => 255],
            [['bankId'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::className(), 'targetAttribute' => ['bankId' => 'id']],
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
            'bankName' => 'Bank',
            'number' => 'Number',
            'type' => 'Type',
            'description' => 'Description',
            'name' => 'Name',
            'lastname' => 'Lastname',
            'rut' => 'Rut',
            'email' => 'Email',
            'minAmount' => 'Min Amount',
            'maxAmount' => 'Max Amount',
            'currencyName' => 'Currency',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['id' => 'bankId']);
    }
    
    public function getBankName() {
        return $this->bank->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currencyId']);
    }
    
    public function getCurrencyName() {
        return $this->currency->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['accountAdminId' => 'id']);
    }
}
