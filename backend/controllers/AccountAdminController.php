<?php

namespace backend\controllers;

use Yii;
use common\models\AccountAdmin;
use common\models\AccountAdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * AccountAdminController implements the CRUD actions for AccountAdmin model.
 */
class AccountAdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['user'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin', 'root'],
                    ]
                ],
            ],
        ];
    }

    /**
     * Lists all AccountAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new AccountAdmin model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccountAdmin();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AccountAdmin model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AccountAdmin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id){
        $model = $this->findModel($id);
        
        // Check if the account is related to any transaction
        $transactions = $model->getTransactions()->count();
        
        if ($transactions > 0){
            Yii::$app->getSession()->setFlash('error','La cuenta bancaria no puede ser eliminada porque hay transacciones relacionadas con ella.');
        }
        else {
            $this->findModel($id)->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the AccountAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccountAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccountAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Change exchange rate status
     *
     * @return string
     */
    public function actionStatus(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $model = AccountAdmin::findOne($data['id']);
            
            if ($model->status)
                $model->status = 0;
            else
                $model->status = 1;
            
            $model->save();
        }

        return null;
    }
}
