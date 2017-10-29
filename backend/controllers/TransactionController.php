<?php

namespace backend\controllers;

use Yii;
use common\models\AccountAdmin;
use common\models\ExchangeRate;
use common\models\Transaction;
use common\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
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
                        'actions' => ['index', 'view', 'update'],
                        'roles' => ['admin', 'root', 'simple'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['winnings'],
                        'roles' => ['admin', 'root'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())){
            $load = Yii::$app->request->post();
            
            // Check if the user is gonna cancel the transaction or mark it as pending
            if ($load['Transaction']['status'] == 1 || $load['Transaction']['status'] == 0){
                $model->userId = Yii::$app->user->id;
                $model->transactionResponseDate = Yii::$app->formatter->asDate($load['Transaction']['transactionResponseDate'], 'yyyy-MM-dd');
                
                if ($model->save()){
                    return $this->redirect(['index']);
                }
                else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
            else {
                // Check if there's "emough money in the account to make this transaction"
                //$accountAdmin = AccountAdmin::find()->where(['id' => $load['Transaction']['accountAdminIdFrom']])->one();
                
                // Available money in all of the accounts
                $er = ExchangeRate::find()->where(['id' => $model->exchangeId])->one();
                
                $accountAdmin = new AccountAdmin();
                $available = $accountAdmin->getAmountSumByCurrency($er->currencyIdTo);
                
                //$transaction = new Transaction();
                //$total = $transaction->getTransactionSumByAA($load['Transaction']['accountAdminIdFrom']);
                
                //if (($accountAdmin->maxAmount - $total['total']) >= $model->amountTo){
                if ($available['total'] >= $model->amountTo){
                    $model->userId = Yii::$app->user->id;
                    $model->transactionResponseDate = Yii::$app->formatter->asDate($load['Transaction']['transactionResponseDate'], 'yyyy-MM-dd');
                    
                    if ($model->save()){
                        return $this->redirect(['index']);
                    }
                    else {
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }
                }
                else {
                    Yii::$app->getSession()->setFlash('error','La cantidad solicitada no se encuentra disponible en la cuenta seleccionada.');
                    
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    *   Calculate winnings report in base currency
    **/
    public function actionWinnings(){
        
        $searchModel = new TransactionSearch();
        $total = "";
        
        if (Yii::$app->request->post()){
            $load = Yii::$app->request->post();
            
            // Check data provided
            if (!isset($load['startDate'])){
                $load['startDate'] = "";
                $startDate = "";
            }
            
            $startDate = $load['startDate'];
            
            if (!isset($load['endDate'])){
                $load['endDate'] = "";
                $endDate = "";
            }
            
            $endDate = $load['endDate'];
            
            $status = $load['status'];
            
            $startDate = Yii::$app->formatter->asTimestamp($load['startDate'], 'dd-MM-yyyy');
            $endDate = Yii::$app->formatter->asTimestamp($load['endDate'], 'dd-MM-yyyy');
            
            if ($endDate < $startDate){
                Yii::$app->getSession()->setFlash('error','La fecha de inicio no puede ser mayor a la de fin.');
                $dataProvider = $searchModel->searchReport(['startDate' => date('d-M-yyyy'), 'endDate' => date('d-M-yyyy'), 'status' => ""]); 
            }
            else {
                $dataProvider = $searchModel->searchReport(['startDate' => $startDate, 'endDate' => $endDate, 'status' => $status]);
                
                // Total winnings
                $total = 0;
                foreach ($dataProvider->models as $item) {
                    if ($item['winnings'] != ""){
                        $total += $item['winnings'];
                    }
                }
            }
        }
        else {
           $dataProvider = $searchModel->searchReport(['startDate' => date('d-M-yyyy'), 'endDate' => date('d-M-yyyy'), 'status' => ""]);
           $startDate = "";
           $endDate = "" ;
           $status = "";
           $total = "";
        }
        
        return $this->render('winnings', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'status' => $status,
                'total' => $total
            ]);
        
    }
}
