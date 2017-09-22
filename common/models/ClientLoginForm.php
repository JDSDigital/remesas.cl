<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ClientLoginForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;
    private $_email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nombre',
            'email' => 'Correo',
            'password' => 'Contraseña',
            'rememberMe' => 'Recordar',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getEmail();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getEmail(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Client::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    protected function getEmail()
    {
        if ($this->_email === null) {
            $this->_email = Client::findByEmail($this->email);
        }

        return $this->_email;
    }
}
