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
            ['name', 'required', 'message' => 'Debe escribir su nombre.'],
            ['lastName', 'required', 'message' => 'Debe escribir su apellido.'],
            ['rut', 'required', 'message' => 'Debe escribir su rut o cédula.'],
            //['phone', 'required', 'message' => 'Debe escribir su numero de telefono.'],
            ['mobile', 'required', 'message' => 'Debe escribir su número de teléfono móvil.'],
            ['email', 'required', 'message' => 'Debe escribir su correo electrónico.'],
            ['password', 'required', 'message' => 'La clave no debe estar vacia.'],
            [['name', 'lastName', 'rut', 'phone', 'mobile', 'email'], 'trim'],
            ['email', 'email', 'message' => 'El correo electronico no es válido'],
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
