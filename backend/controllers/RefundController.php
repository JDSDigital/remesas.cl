<?php

namespace backend\controllers;

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
     * Updates an existing Refund model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())){
            $load = Yii::$app->request->post();
           
            $model->userId = Yii::$app->user->id;
            $model->responseDate = Yii::$app->formatter->asDate($load['Refund']['responseDate'], 'yyyy-MM-dd');
            
            if ($model->save()){
                // Update Transaction status
                $tr = Transaction::findOne($model->transactionId);
                $tr->status = Transaction::STATUS_CANCELLED;
                $tr->transactionResponseDate = date('Y-m-d');
                $tr->winnings = 0;
                $tr->save();
                
                return $this->redirect(['/transaction/index']);
            }
            else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
