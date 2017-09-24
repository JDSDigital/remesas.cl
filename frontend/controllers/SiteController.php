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
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
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
                Yii::$app->session->setFlash('error', $error);
            }
            return $this->render('login');
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
            return $this->render('contact', [
                'model' => $model,
            ]);
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
            $email = \Yii::$app->mailer->compose()
                    ->setTo($user->email)
//                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setFrom([Yii::$app->params['supportEmail'] => 'Geknology Core'])
                    ->setSubject('Signup Confirmation')
                    ->setHtmlBody("Click this link <a href='http://geknology.com/remesas.cl/site/confirm?id=" . $user->id . "&key=" . $user->auth_key . "' target='_blank'>confirm</a>")
                    ->send();
                    
                    if($email){
                        Yii::$app->getSession()->setFlash('success','Check Your email!');
                    }
                    else{
                        Yii::$app->getSession()->setFlash('warning','Failed, contact Admin!');
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
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
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
            Yii::$app->session->setFlash('success', 'New password saved.');

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
            Yii::$app->getSession()->setFlash('success','Success!');
        }
        else {
            Yii::$app->getSession()->setFlash('warning','Failed!');
        }
        return $this->goHome();
    }
    
    /**
     * List of the site's available bank accounts 
     */
    public function actionAccounts(){
        $model = new AccountAdmin();
        $accounts = $model->getActiveAccounts();
        
        return $this->render('accounts', [
            'accounts' => $accounts,
        ]);
    }
    
    /**
     * Helps the user to make some exchange calculations before making a transaction 
     */
    public function actionCalculator(){
        
        $model = new ExchangeRate();
        $result = null;
        $amount = 1;
        
        // Get $_POST data
        $load = Yii::$app->request->post();
        
        if ($load != null){
            $model->currencyIdFrom = $load['currencyIdFrom'];
            $model->currencyIdTo = $load['currencyIdTo'];
            $amount = $load['amount'];
            
            if ($load['amount'] == ""){
                Yii::$app->getSession()->setFlash('error','Debe introducir una cantidad a convertir');
            }
            else if ($load['currencyIdFrom'] == $load['currencyIdTo']){
                Yii::$app->getSession()->setFlash('error','Las monedas de conversi�n deben ser diferentes');
            }
            else {
                // Search for an exchange rate with these conditions
                $ct = Currency::find()->where(['id' => $model->currencyIdTo])->one();
                $er1 = ExchangeRate::find()->where(['and', ['currencyIdFrom' => $load['currencyIdFrom']], ['currencyIdTo' => $load['currencyIdTo']]])->one();
                
                // Depending on the from currency
                if ($er1 != null){
                    
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
                    
                    $result = $calculate." ".$ct->symbol;
                }
                else {
                   Yii::$app->getSession()->setFlash('error','Lo sentimos. La tasa de cambio solicitada no est� disponible. Por favos intente m�s tarde.');
                }
            } 
        }
        
        return $this->render('calculator', [
            'model' => $model,
            'result' => $result,
            'amount' => $amount
        ]);
    }
}
