<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Client model
 *
 * @property integer $id
 * @property string $name
 * @property string $lastName
 * @property string $rut
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $username
 * @property string $role
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $blocked
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password

 * @property AccountClient[] $accountsClients
 * @property Transaction[] $transactions
 */
class Client extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const ROLE_CLIENT = 'client';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gclients}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['blocked', 'default', 'value' => self::STATUS_DELETED],
            ['blocked', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['role', 'default', 'value' => self::ROLE_CLIENT],
            ['name', 'required', 'message' => 'Debe escribir su nombre.'],
            ['lastName', 'required', 'message' => 'Debe escribir su apellido.'],
            ['rut', 'required', 'message' => 'Debe escribir su identificación personal.'],
            ['phone', 'required', 'message' => 'Debe escribir su numero de telefono.'],
            ['mobile', 'required', 'message' => 'Debe escribir su numero de telefono movil.'],
            ['email', 'required', 'message' => 'Debe escribir su correo electrónico.'],
            ['password_hash', 'required', 'message' => 'La clave no debe estar vacia.'],
            [['username', 'role', 'auth_key'], 'required'],
            [['status', 'blocked', 'created_at', 'updated_at'], 'integer'],
            [['name', 'lastName', 'rut', 'phone', 'mobile', 'email', 'username', 'role', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
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
            'username' => 'Username',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * Find one, same id, status active, non-blocked
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE, 'blocked' => self::STATUS_DELETED]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE, 'blocked' => self::STATUS_DELETED]);
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE, 'blocked' => self::STATUS_DELETED]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['client.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountsClients()
    {
        return $this->hasMany(AccountClient::className(), ['clientId' => 'id']);
    }
    
    public function getAccountsClientsCount()
    {
        return AccountClient::find()->where(['clientId' => $this->id])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['clientId' => 'id']);
    }
    
    public function getDisplayName(){
        return $this->name." ".$this->lastName;
    }
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountClient($acc = null){
        
        $connection = Yii::$app->getDb();
        
        if ($acc != null){
            $command = $connection->createCommand("
                SELECT b.name as bank, ac.*  
                FROM gaccounts_clients ac 
                LEFT JOIN gbanks b ON (ac.bankId = b.id)
                WHERE ac.clientId = ".$this->id." 
                AND ac.id = ".$acc);
        }
        else {
            $command = $connection->createCommand("
                SELECT b.name as bank, ac.*  
                FROM gaccounts_clients ac 
                LEFT JOIN gbanks b ON (ac.bankId = b.id)
                WHERE ac.clientId = ".$this->id);
        }
        
        $result = $command->queryAll();
        return $result;
    }
}
