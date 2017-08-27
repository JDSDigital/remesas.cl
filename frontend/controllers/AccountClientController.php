<?php

namespace frontend\controllers;

use Yii;
use common\models\AccountClient;
use common\models\AccountClientSearch;
use common\models\Bank;
use common\models\Client;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountClientController implements the CRUD actions for AccountClient model.
 */
class AccountClientController extends Controller
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
        ];
    }

    /**
     * Lists all AccountClient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountClientSearch();
        $searchModel->clientId = Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new AccountClient model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // Check the number of accounts of the current client
        $ac = AccountClient::find()->where(['clientId' => Yii::$app->user->id])->count();
        
        // If the Client has less than three accounts created...
        if ($ac < 3){
            $model = new AccountClient();
            $model->clientId = Yii::$app->user->id;
            
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        else {
            Yii::$app->getSession()->setFlash('error','Usted posee tres cuentas bancarias agregadas, si desea agregar una cuenta nueva debe eliminar alguna de las anteriores.');
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing AccountClient model.
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
            // Get the countrId for the selected bank
            $countryId = $model->bank->countryId; 
            
            return $this->render('update', [
                'model' => $model,
                'countryId' => $countryId
            ]);
        }
    }

    /**
     * Deletes an existing AccountClient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id){
        
        // Check wether the account is being used in any transaction
        $model = $this->findModel($id);
        $transactions = $model->getTransactions()->count();
        
        if ($transactions > 0){
            Yii::$app->getSession()->setFlash('error','La cuenta no puede ser borrada ya que usted ha hecho transacciones en Remesas con ella.');
        }
        else {
            $this->findModel($id)->delete();
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the AccountClient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccountClient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccountClient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // List banks according to the selected country
    public function actionListb($id){
        $countBanks = Bank::find()
                    ->where(['countryId' => $id])
                    ->count();
                    
        $banks = Bank::find()
                ->where(['countryId' => $id])
                ->orderBy('name')
                ->all();

        if ($countBanks>0){
            foreach($banks as $bank){
                echo "<option value='".$bank->id."'>".$bank->name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
    }
}
