<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\AccountAdmin;
use common\models\ClientLoginForm;
use common\models\Client;
use common\models\Currency;
use common\models\ExchangeRate;
use common\models\Transaction;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    const STATUS_OK = 0;
    const STATUS_QUANTITY = 1;
    const STATUS_CURRENCY = 2;
    const STATUS_AVAILABILITY = 3;
    const STATUS_RATES = 4;
    const STATUS_MINIMUM = 5;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'accounts', 'calculator'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'accounts', 'calculator'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $contact = new ContactForm();
        $passwordReset = new PasswordResetRequestForm();

        if ($passwordReset->load(Yii::$app->request->post()) && $passwordReset->validate()) {
            if ($passwordReset->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Revise su correo para las instrucciones.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Lo sentimos, no pudimos resetear la contraseña para esta dirección de correo.');
            }
        }

        return $this->render('index', [
            'contact' => $contact,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $model = new ClientLoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            foreach ($model->errors as $error) {
                Yii::$app->session->setFlash('error', 'Correo o contraseña incorrectas.');
            }
            return $this->actionIndex();
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->actionIndex();
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup(){

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
            $email = Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom([Yii::$app->params['supportEmail'] => 'Remesas.cl'])
                    ->setSubject('Confirmación de cuenta')
                    ->setHtmlBody("Haga click en el siguiente enlace para activar su cuenta: " . Html::a('Activar', Url::to(['/site/confirm', 'id' => $user->id, 'key' => $user->auth_key], true), ['target' => '_blank']))
                    ->send();
                    
                    if($email){
                        Yii::$app->getSession()->setFlash('success','Registro correcto. Revise su correo para continuar con la activación de su cuenta.');
                    }
                    else{
                        Yii::$app->getSession()->setFlash('warning','Registro fallido. Por favor intentar mas tarde.');
                    }
                    return $this->goHome();
            }
        }
         
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Revise su correo para las instrucciones.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Lo sentimos, no pudimos reiniciar la contraseña para esta dirección de correo.');
            }
        }

        return $this->render('index');
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Nueva contraseña guardada.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    /**
     * Confirm Client's email address 
     */
    public function actionConfirm($id, $key){
        $user = Client::find()->where(['id'=>$id, 'auth_key'=>$key, 'status'=>0])->one();

        if (!empty($user)){
            $user->status = 1;
            $user->save();
            Yii::$app->getSession()->setFlash('success','Se ha activado su cuenta con éxito.');
        }
        else {
            Yii::$app->getSession()->setFlash('warning','No se ha podido activar su cuenta, por favor intente mas tarde.');
        }
        return $this->goHome();
    }
    
    /**
     * List of the site's available bank accounts 
     */
    public function actionAccounts(){
        return $this->render('accounts');
    }
    
    /**
     * Helps the user to make some exchange calculations before making a transaction 
     */
    public function actionCalculator(){

        $model = new ExchangeRate();
        $result = null;

        // Get $_POST data
        $load = Yii::$app->request->post();

        if ($load != null){
            $model->currencyIdFrom = $load['currencyIdFrom'];
            $model->currencyIdTo = $load['currencyIdTo'];

            if ($load['amount'] == ""){
                return self::STATUS_QUANTITY;
            } else if ($load['currencyIdFrom'] == $load['currencyIdTo']) {
                return self::STATUS_CURRENCY;
            } else {
                // Search for an exchange rate with these conditions
                $ct = Currency::find()->where(['id' => $model->currencyIdTo])->one();
                $er1 = ExchangeRate::find()->where([
                    'and',
                    ['currencyIdFrom' => $load['currencyIdFrom']],
                    ['currencyIdTo' => $load['currencyIdTo']],
                    ['status' => 1]
                ])->one();
                
                // Depending on the from currency
                if ($er1 != null){

                    /**
                     * Check exchange rates depending on base currency (Pesos)
                     */
                    
                    // Multiply
                    if ($model->currencyIdFrom == 1){
                        $calculate = $load['amount']*$er1->sellValue;
                    }
                    // Divide
                    else if ($model->currencyIdTo == 1){
                        $calculate = $load['amount']/$er1->sellValue;
                    }
                    // For the future...
                    else {
                        $calculate = $load['amount']*$er1->sellValue;
                    }
                    
                    // Search for the available money on the accounts
                    // Available money in all of the accounts
                    $accountAdmin = new AccountAdmin();
                    $minimum = $accountAdmin->getMinimumAmount($load['currencyIdFrom']);
                    $available = $accountAdmin->getAmountSumByCurrency($load['currencyIdTo']);

                    if ($load['amount'] < $minimum)
                        return self::STATUS_MINIMUM;

                    // Substract the money of the transactions received during this day
                    $transaction = new Transaction();
                    $total = $transaction->getTransactionSumByAA();
                    
                    if ($available['total'] - $total['total'] >= $calculate){

                        /**
                         * Sets the amount from and the currencies id's as session variables
                         */
                        Yii::$app->session->set('amountFrom', $load['amount']);
                        Yii::$app->session->set('currencyIdFrom', $load['currencyIdFrom']);
                        Yii::$app->session->set('currencyIdTo', $load['currencyIdTo']);

                        return Yii::$app->formatter->asDecimal(Html::encode($calculate), 2)." ".$ct->symbol;
                    }
                    else {
                        return self::STATUS_AVAILABILITY;
                    }
                } else {
                   return self::STATUS_RATES;
                }
            }
        } else {
            return $this->render('//site/calculator', [
                'model' => $model,
                'result' => $result,
            ]);
        }
    }
}
