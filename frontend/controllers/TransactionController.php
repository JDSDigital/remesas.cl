<?php

namespace frontend\controllers;

use Yii;
use common\models\AccountAdmin;
use common\models\ExchangeRate;
use common\models\Transaction;
use common\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
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
        $dataProvider->query->where('gtransactions.clientId = '.Yii::$app->user->id);

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
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($amountFrom = null, $exchangeId = null, $amount = null){

        if (!Yii::$app->session['amountFrom']) {
            return $this->redirect(['//site/index']);
        }

        $model = new Transaction();

        if ($model->load(Yii::$app->request->post())){
            $load = Yii::$app->request->post();
            
            $model->clientId = Yii::$app->user->id;

            // Exchange Rate Used
            $er = ExchangeRate::find()->where(['id' => $load['Transaction']['exchangeId']])->one();
            $model->currencyIdFrom = $er->currencyIdFrom;
            $model->currencyIdTo = $er->currencyIdTo;
            $model->sellRateValue = $er->sellValue;
            $model->buyRateValue = $er->buyValue;
            
            // Check if I should multiply or divide according to the "base" currency (id=1)
            // Multiply
            if ($model->currencyIdFrom == 1){
               $model->amountTo = $model->amountFrom*$model->sellRateValue;
               $model->usedValue = $model->sellRateValue;
               $model->winnings = ($model->amountTo/$model->sellRateValue) - ($model->amountTo/$model->buyRateValue);
            }
            // Divide
            else if ($model->currencyIdTo == 1){
                $model->amountTo = $model->amountFrom/$model->sellRateValue;
                $model->usedValue = $model->sellRateValue;
                $model->winnings = ($model->amountFrom/$model->buyRateValue) - $model->amountTo;
            }
            // For the future...
            else {
                $model->amountTo = $model->amountFrom*$model->sellRateValue;
                $model->usedValue = $model->sellRateValue;
                $model->winnings = ($model->amountTo/$model->sellRateValue) - ($model->amountTo/$model->buyRateValue);
            }
            
            // Look for the account the user tranfered the money to and update the available amount of money
            //$accountAdmin = AccountAdmin::find()->where(['id' => $load['Transaction']['accountAdminId']])->one();
            
            // Look for the available amount of money in every account of the To 
            //$accountAdmin = new AccountAdmin();
            //$accounts = $accountAdmin->getAccountsAvailableMoney($model->amountTo);
            
            // Available money in all of the accounts
            $accountAdmin = new AccountAdmin();
            $available = $accountAdmin->getAmountSumByCurrency($er->currencyIdTo);
            
            // If the account "has" the money... continue
            if ($available['total'] >= $model->amountTo){
                $model->transactionDate = Yii::$app->formatter->asDate($_POST['Transaction']['transactionDate'], 'yyyy-MM-dd');
            
                // Transaction receipt
                $upload_file = UploadedFile::getInstance($model, 'uploadFile');
    
                if (!empty($upload_file) && $upload_file->size !== 0){
                    $model->uploadFile = $upload_file;
                    
                    if ($model->validate()){
                        if ($model->save()){
                            $upload_file->saveAs('uploads/t-'.$model->id.'.'.$upload_file->extension);

                            /**
                             * Unsets the session variables
                             */

                            Yii::$app->session->remove('amountFrom');
                            Yii::$app->session->remove('currencyIdFrom');
                            Yii::$app->session->remove('currencyIdTo');

                            // "Substract" the amountTo from the account
                            //$accountAdmin->maxAmount = $accountAdmin->maxAmount - $model->amountTo;
                            //$accountAdmin->save();
                            
                            return $this->redirect(['index']);
                        }
                        else {
                            Yii::$app->getSession()->setFlash('error', 'Ha ocurrido un error. Por favor, intente de nuevo.');
                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }
                    }
                    else {
                        Yii::$app->getSession()->setFlash('error', 'Ha ocurrido un error. Por favor, intente de nuevo.');
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                }
                else {
                    Yii::$app->getSession()->setFlash('error', 'Debe agregar el comprobante de la transacción.');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                } 
            }
            else {
                Yii::$app->getSession()->setFlash('error','La cantidad solicitada no se encuentra disponible. Por favor pruebe con un monto más bajo.');

                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            
            /*$er1 = ExchangeRate::find()->where(['and', ['currencyIdFrom' => $load['Transaction']['currencyIdFrom']], ['currencyIdTo' => $load['Transaction']['currencyIdTo']]])->one();
            
            if ($er1 != null){
                $model->sellRateValue = $er1->sellValue;
                $model->buyRateValue = $er1->buyValue;
                $model->amountTo = $model->amountFrom*$model->sellRateValue;
                $model->usedValue = $er1->sellValue;
            }
            else {
               $er2 = ExchangeRate::find()->where(['and', ['currencyIdFrom' => $load['Transaction']['currencyIdTo']], ['currencyIdTo' => $load['Transaction']['currencyIdFrom']]])->one();
               
               if ($er2 != null){
                   $model->sellRateValue = $er2->sellValue;
                   $model->buyRateValue = $er2->buyValue;
                   $model->amountTo = $model->amountFrom/$model->buyRateValue;
                   $model->usedValue = $er2->buyValue;
               } 
            }*/    
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * User transactions gridview
     *
     * @return string
     */
    public function actionCheck()
    {

        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('gtransactions.clientId = '.Yii::$app->user->id);

        return $this->render('check', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        /**
         * Old Check Method
         */
        /*$load = Yii::$app->request->post();

        $er = ExchangeRate::find()->where(['id' => $load['CheckForm']['rate']])->one();

        // Available money in all of the accounts
        $accountAdmin = new AccountAdmin();
        $available = $accountAdmin->getAmountSumByCurrency($er->currencyIdTo);
        
        // If the account "has" the money... continue
        if ($available['total'] >= ($load['CheckForm']['amount'] * $er->sellValue)){

            $exchangeId = $load['CheckForm']['rate'];
            $amountFrom = $load['CheckForm']['amount'];

            return $this->actionCreate($amountFrom, $exchangeId);

        } else {
            Yii::$app->getSession()->setFlash('error','La cantidad solicitada no se encuentra disponible. Por favor pruebe con un monto más bajo.');
            return $this->actionIndex();
        }*/
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
}
