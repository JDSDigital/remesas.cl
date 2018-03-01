<?php

namespace backend\controllers;

use Exception;
use Yii;
use common\models\AccountAdmin;
use common\models\ExchangeRate;
use common\models\Model;
use common\models\Transaction;
use common\models\TransactionSearch;
use common\models\TransactionsParts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

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
        $modelsParts = $model->transactionParts;
        
        if ($model->load(Yii::$app->request->post())){
            $load = Yii::$app->request->post();
            
            $oldIDs = ArrayHelper::map($modelsParts, 'id', 'id');
            $modelsParts = Model::createMultiple(TransactionsParts::classname(), $modelsParts);
            Model::loadMultiple($modelsParts, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsParts, 'id', 'id')));

            if ($load['Transaction']['status'] == Transaction::STATUS_DONE){
                // Available money in all of the accounts
                $er = ExchangeRate::find()->where(['id' => $model->exchangeId])->one();
                
                $accountAdmin = new AccountAdmin();
                $available = $accountAdmin->getAmountSumByCurrency($er->currencyIdTo);
                
                if (!$available['total'] >= $model->amountTo){
                    Yii::$app->getSession()->setFlash('error','La cantidad solicitada no se encuentra disponible en la cuenta seleccionada.');
                    
                    return $this->render('update', [
                        'model' => $model,
                        'modelsParts' => (empty($modelsParts)) ? [new TransactionsParts] : $modelsParts
                    ]);
                }
            }
            
            $model->userId = Yii::$app->user->id;

            if ($model->transactionResponseDate == '')
                $model->transactionResponseDate = date('Y-m-d');
            else
                $model->transactionResponseDate = Yii::$app->formatter->asDate($load['Transaction']['transactionResponseDate'], 'yyyy-MM-dd');

            try {
                if ($model->save()) {
                    if (! empty($deletedIDs)) {
                        TransactionsParts::deleteAll(['id' => $deletedIDs]);
                    }

                    foreach ($modelsParts as $i => $modelPart) {
                        $modelPart->transactionId = $model->id;
                        $modelPart->transactionResponseDate = $model->transactionResponseDate;
                        
                        // Upload Receipt
                        $upload_file = UploadedFile::getInstance($modelPart, "[{$i}]uploadFile");

                        if (!empty($upload_file) && $upload_file->size !== 0){
                            $fileName = $model->id . '-' . $i . '.' . $upload_file->extension;
                            $modelPart->uploadFile = $fileName;
                            $upload_file->saveAs('uploads/' . $fileName);
                        }
                        
                        if (!$modelPart->save()) {
                            foreach ($modelPart->errors as $error)
                                Yii::$app->session->setFlash('error', $error);
                        }
                    }

                    return $this->redirect(['index']);
                } else {
                    foreach ($model->errors as $error)
                        Yii::$app->session->setFlash('error', $error);

                    return $this->render('update', [
                        'model' => $model,
                        'modelsParts' => (empty($modelsParts)) ? [new TransactionsParts] : $modelsParts
                    ]);
                }
            }
            catch (Exception $e) {
                return $this->render('update', [
                    'model' => $model,
                    'modelsParts' => (empty($modelsParts)) ? [new TransactionsParts] : $modelsParts
                ]);
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
                'modelsParts' => (empty($modelsParts)) ? [new TransactionsParts] : $modelsParts
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
