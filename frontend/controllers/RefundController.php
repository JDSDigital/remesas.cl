<?php

namespace frontend\controllers;

use Yii;
use common\models\Refund;
use common\models\RefundSearch;
use common\models\Transaction;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefundController implements the CRUD actions for Refund model.
 */
class RefundController extends Controller
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
     * Lists all Refund models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefundSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Refund model.
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
     * Creates a new Refund model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($t = null)
    {   
        // Create a new Refund petition for this transaction
        if ($t != null){
            // Get Transaction
            $transaction = Transaction::find()->where(['id' => $t])->one();

            if ($transaction){
                if ($transaction->status != 0){
                    Yii::$app->getSession()->setFlash('error','Ha ocurrido un error. Por favor intente de nuevo.');
                    return $this->redirect(['/transaction/index']); 
                }
                else {
                    $model = new Refund();
                    
                    if ($model->load(Yii::$app->request->post())) {
                        $load = Yii::$app->request->post();
            
                        $model->clientId = Yii::$app->user->id;
                        $model->transactionId = (int) $t;
            
                        if ($model->save()){
                            return $this->redirect(['/transaction/index']);
                        }
                        else {
                            return $this->render('create', [
                                'model' => $model,
                                't' => $t
                            ]);
                        }
                    }
                    else {
                        return $this->render('create', [
                            'model' => $model,
                            't' => $t
                        ]);
                    }
                }
            }
            else {
                Yii::$app->getSession()->setFlash('error','Ha ocurrido un error. Por favor intente de nuevo.');
                return $this->redirect(['/transaction/index']);
            }
        }
        else {
            Yii::$app->getSession()->setFlash('error','Ha ocurrido un error. Por favor intente de nuevo.');
            return $this->redirect(['/transaction/index']); 
        }   
    }

    /**
     * Updates an existing Refund model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Refund model.
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
     * Finds the Refund model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Refund the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Refund::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
