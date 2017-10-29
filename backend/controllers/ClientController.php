<?php

namespace backend\controllers;

use Yii;
use common\models\Client;
use common\models\ClientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
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
                        'actions' => ['index', 'view', 'update', 'blocked'],
                        'roles' => ['admin', 'root'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['accounts'],
                        'roles' => ['admin', 'root', 'simple'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
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
     * Updates an existing Client model.
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
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Block or Unblock Client.
     *
     * @return string
     */
    public function actionBlocked()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $model = Client::findOne($data['id']);
            
            if ($model->blocked)
                $model->blocked = 0;
            else
                $model->blocked = 1;
            
            $model->save();
        }

        return null;
    }
    
    /**
    * Get Client Bank Accounts
    **/
    public function actionAccounts($id, $acc = null){
        $model = Client::findOne($id);
        
        // Get this account
        if ($acc != null){
            $accounts = $model->getAccountClient($acc);
        }
        // Get all accounts
        else {
            $accounts = $model->getAccountClient();
        }
        
        $provider = new ArrayDataProvider([
            'allModels' => $accounts,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        
        return $this->render('accounts', [
            'model' => $model,
            'accounts' => $accounts,
            'dataProvider' => $provider,
        ]);
    }
}
