<?php
namespace backend\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\UserForm;
use common\models\User;


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
                        'actions' => ['logout', 'index', 'profile', 'create', 'update', 'delete'],
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

    /**
     * Displays User Create Form.
     *
     * @return string
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect(['login']);

        $model = new UserForm();
        
        if($model->load(Yii::$app->request->post())){
            if($model->create()){
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Displays User Update Form.
     * 
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = UserForm::findOne($id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->new_password != '')
                $model->setPassword($model->new_password);

            $model->update();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Delete User.
     *
     * @return string
     */
    public function actionDelete($id)
    {
        $model = User::find()->where(['id' => $id])->one();

        if($model->delete()){
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
