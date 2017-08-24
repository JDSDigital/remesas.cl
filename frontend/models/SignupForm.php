<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Client;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $lastName;
    public $rut;
    public $phone;
    public $mobile;
    public $username;
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Client', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],*/

            [['name', 'lastName', 'rut', 'phone', 'mobile', 'email'], 'trim'],
            [['name', 'lastName', 'rut', 'phone', 'mobile', 'email', 'password'], 'required'],
            ['email', 'email'],
            [['name', 'lastName', 'rut', 'phone', 'mobile', 'email'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Client', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Client();
        
        $user->name = $this->name;
        $user->lastName = $this->lastName;
        $user->rut = $this->rut;
        $user->phone = $this->phone;
        $user->mobile = $this->mobile;
        $user->email = $this->email;
        $user->username = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = 0;
        
        return $user->save() ? $user : null;
    }
}
