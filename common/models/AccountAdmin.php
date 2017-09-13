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
            ['description', 'required', 'message' => 'Debe escribir una descripción para la cuenta.'],
            ['number', 'required', 'message' => 'El número de la cuenta no puede estar vacío.'],
            ['name', 'required', 'message' => 'Debe escribir el nombre del dueño de la cuenta.'],
            ['lastname', 'required', 'message' => 'Debe escribir el apellido del dueño de la cuenta.'],
            ['rut', 'required', 'message' => 'Debe escribir la identificación personal del dueño de la cuenta.'],
            ['email', 'required', 'message' => 'Debe escribir el correo electrónico del dueño de la cuenta.'],
            ['minAmount', 'required', 'message' => 'Introduzca la cantidad mínima para realizar una transacción.'],
            ['maxAmount', 'required', 'message' => 'Introduzca la cantidad máxima diaria para transacciones en esta cuenta.'],
            ['email', 'email', 'message' => 'El correo electronico no es válido'],
            [['bankId', 'type', 'currencyId'], 'required'],
            [['bankId', 'currencyId', 'status'], 'integer'],
            [['minAmount', 'maxAmount'], 'number'],
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
    
    /**
     * Get active accounts
     */
    public function getActiveAccounts(){
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT b.name as bank, c.name as country, ac.number, 
            ac.name, ac.lastname, ac.rut, ac.email, ac.type  
            FROM gaccounts_admin ac 
            LEFT JOIN gbanks b ON (ac.bankId = b.id) 
            LEFT JOIN gcountries c ON (b.countryId = c.id) 
            WHERE ac.status = 1");

        $result = $command->queryAll();
        return $result;
    }
    
    /**
     * Get accounts with available money
    **/
    public function getAccountsAvailableMoney($amount){
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT id  
            FROM gaccounts_admin
            WHERE status = 1 AND maxAmount >= ".$amount);

        $result = count($command->queryAll());
        return $result;
    }
    
    /**
     * Get the available money for the accounts in this currency
    **/
    public function getAmountSumByCurrency($currency){
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT sum(ac.maxAmount) AS total 
            FROM gaccounts_admin ac 
            WHERE ac.status = 1 AND ac.currencyId = ".$currency);
        
        $result = $command->queryOne();
        return $result;
    }
}
