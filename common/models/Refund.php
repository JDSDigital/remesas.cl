<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grefunds".
 *
 * @property integer $id
 * @property integer $clientId
 * @property integer $transactionId
 * @property string $motivation
 * @property integer $status
 * @property string $responseDate
 * @property string $observation
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $userId
 *
 * @property Client $client
 * @property Transaction $transaction
 * @property User $user
 */
class Refund extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_DISMISSED = 1;
    const STATUS_DONE = 2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grefunds';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'transactionId', 'motivation', 'status'], 'required'],
            [['clientId', 'transactionId', 'status', 'created_at', 'updated_at', 'userId'], 'integer'],
            [['responseDate'], 'safe'],
            [['motivation', 'observation'], 'string', 'max' => 255],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['clientId' => 'id']],
            [['transactionId'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['transactionId' => 'id']],
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
            'transactionId' => 'Transaction ID',
            'motivation' => 'Motivation',
            'status' => 'Status',
            'responseDate' => 'Response Date',
            'observation' => 'Observation',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient(){
        return $this->hasOne(Client::className(), ['id' => 'clientId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction(){
        return $this->hasOne(Transaction::className(), ['id' => 'transactionId']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
