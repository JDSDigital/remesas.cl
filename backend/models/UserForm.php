<?php
namespace backend\models;


use Yii;
use common\models\User;


/**
 * Create User form
 */
class UserForm extends User
{
//    public $username;
//    public $email;
    public $password;
    public $new_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [
                'username',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => 'This username has already been taken.',
                'when' => function($model) {
                    return $this->getOldAttribute('username') !== $model->username;
                }
            ],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => 'This email address has already been taken.',
                'when' => function($model) {
                    return $this->getOldAttribute('email') !== $model->email;
                }
            ],

            ['password', 'required', 'on' => 'insert'],
            ['password', 'string', 'min' => 6],

//            ['new_password', 'required'],
            ['new_password', 'string', 'min' => 6],
        ];
    }

    /**
     * Creates User.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function create()
    {
        if(!$this->validate()){
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
