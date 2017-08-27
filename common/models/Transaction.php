<?php

namespace common\models;

use Yii;

use yii\db\ActiveRecord;
//use yii\web\UploadedFile;

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
 * @property Currency $currencyFrom
 * @property Currency $currencyTo
 */
class Transaction extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_CANCELLED = 1;
    const STATUS_DONE = 2;
    //public $uploadFile;
    
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
            [['clientId', 'accountClientId', 'amountFrom', 'exchangeValue', 'transactionDate', 'currencyIdFrom', 'currencyIdTo'], 'required'],
            [['clientId', 'accountClientId', 'accountAdminId', 'exchangeId', 'userId', 'clientBankTransaction', 'adminBankTransaction', 'status', 'created_at', 'updated_at', 'currencyIdFrom', 'currencyIdTo'], 'integer'],
            [['amountFrom', 'amountTo', 'exchangeValue', 'winnings'], 'number'],
            [['observation'], 'string', 'max' => 255],
            [['accountAdminId'], 'exist', 'skipOnError' => true, 'targetClass' => AccountAdmin::className(), 'targetAttribute' => ['accountAdminId' => 'id']],
            [['accountClientId'], 'exist', 'skipOnError' => true, 'targetClass' => AccountClient::className(), 'targetAttribute' => ['accountClientId' => 'id']],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['clientId' => 'id']],
            [['exchangeId'], 'exist', 'skipOnError' => true, 'targetClass' => ExchangeRate::className(), 'targetAttribute' => ['exchangeId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['status', 'in', 'range' => [self::STATUS_PENDING, self::STATUS_CANCELLED, self::STATUS_DONE]],
            [['currencyIdFrom'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currencyIdFrom' => 'id']],
            [['currencyIdTo'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currencyIdTo' => 'id']],
            //[['uploadFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
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
            //'uploadFile' => 'Upload File',
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
    
    public function getCurrencyFrom()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currencyIdFrom'])
                    ->from(Currency::tableName() . ' cf');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyTo()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currencyIdTo'])
                    ->from(Currency::tableName() . ' ct');
    }
    
    /*public function uploadFile() {
        // get the uploaded file instance
        $image = UploadedFile::getInstance($this, 'uploadFile');
 
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
 
        // generate random name for the file
        //$this->pic = time(). '.' . $image->extension;
 
        // the uploaded image instance
        return $image;
    }
 
    public function getUploadedFile() {
        // return a default image placeholder if your source avatar is not found
        $pic = isset($this->pic) ? $this->pic : 'default.png';
        return Yii::$app->params['fileUploadUrl'] . $pic;
    }*/
}
