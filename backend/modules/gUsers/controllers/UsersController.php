<?php
namespace backend\modules\gUsers\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\UserForm;
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
                        'actions' => ['index', 'profile', 'create', 'update', 'delete', 'logout', 'status'],
                        'allow'   => true,
                        'roles'   => ['admin', 'root'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'bedezign\yii2\audit\AuditTrailBehavior',
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
        if (Yii::$app->user->isGuest)
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
        if (Yii::$app->user->isGuest)
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
        if (Yii::$app->user->isGuest)
            return $this->redirect(['login']);

        $model = new UserForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->create()) {
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

            if ($model->password != '')
                $model->setPassword($model->password);

            $model->update();

            /*if ($model->update()){
                Yii::warning('Usuario ' . $model->username . ' actualizado por ' . Yii::$app->user->identity->username, 'gUsers');
                    'gUsers',
                    $this->id,
                    $this->action->id,
                    'Message',
                    $var = null,
                    $status = 'success',
                    $contractId = null);
            } else
                Yii::error('Error al actualizar el usuario ' . $model->username . ' por ' . Yii::$app->user->identity->username, 'gUsers');*/

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
        
        // Check if the user is related to any transactions
        $transactions = $model->getTransactions()->count();
        
        if ($transactions > 0){
            Yii::$app->getSession()->setFlash('error','El usuario no puede ser eliminado porque hay transacciones relacionadas con el.');
        }
        else {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Changes UserStatus.
     *
     * @return string
     */
    public function actionStatus()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $model = UserForm::findOne($data['id']);

            if ($model->status)
                $model->status = 0;
            else
                $model->status = 1;

            $model->save();
        }
//        return $this->refresh();
        return null;
    }
}
