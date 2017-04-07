<?php
namespace backend\controllers;


use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Users controller
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow'   => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'profile'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays User Index.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect(['login']);

        $dataProvider = new ActiveDataProvider([
            'query'      => User::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays User Profile.
     *
     * @return string
     */
    public function actionProfile()
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect(['login']);

        return $this->render('profile');
    }
}
