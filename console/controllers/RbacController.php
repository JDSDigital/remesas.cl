<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "user" role
        $user = $auth->createRole('user');
        $auth->add($user);

        // add "admin" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        // $auth->addChild($admin, $user);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
        $auth->assign($user, 2);
    }
}