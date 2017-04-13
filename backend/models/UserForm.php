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
    //    public $role;
    public $password;

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
                'message'     => 'This username has already been taken.',
                'when'        => function ($model) {
                    return $this->getOldAttribute('username') !== $model->username;
                },
            ],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => '\common\models\User',
                'message'     => 'This email address has already been taken.',
                'when'        => function ($model) {
                    return $this->getOldAttribute('email') !== $model->email;
                },
            ],

            ['role', 'required'],

            ['password', 'required', 'on' => 'insert'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Creates User.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->role = $this->role;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()) {
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole($this->role);
            $auth->assign($authorRole, $user->getId());

            return $user;
        } else
            return null;
    }
}
