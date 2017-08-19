<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gclients".
 *
 * @property integer $id
 * @property string $name
 * @property string $lastName
 * @property string $rut
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $login
 * @property string $password
 * @property integer $status
 * @property integer $blocked
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AccountClient[] $accountsClient
 * @property Transaction[] $transactions
 */
class Client extends \yii\db\ActiveRecord
{   
    const STATUS_ACTIVE = true;
    const STATUS_INACTIVE = false;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gclients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lastName', 'rut', 'phone', 'mobile', 'email', 'password'], 'required'],
            [['status', 'blocked', 'created_at', 'updated_at'], 'integer'],
            [['name', 'lastName', 'rut', 'phone', 'mobile', 'email', 'login', 'password'], 'string', 'max' => 255],
            ['login', 'default', 'value' => self::$email],
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
            'lastName' => 'Last Name',
            'rut' => 'Rut',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'login' => 'Login',
            'password' => 'Password',
            'status' => 'Status',
            'blocked' => 'Blocked',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountsClient()
    {
        return $this->hasMany(AccountClient::className(), ['clientId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['clientId' => 'id']);
    }
}
