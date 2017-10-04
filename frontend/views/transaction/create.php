<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

use common\models\AccountAdmin;
use common\models\AccountClient;
//use common\models\Currency;
use common\models\ExchangeRate;


/* @var $this yii\web\View */
/* @var $model common\models\AccountClient */

$this->title = 'Registrar Depósito / Transferencia';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container account-client-create pt30">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(['id' => 'form-transaction']); ?>
                <?php /*echo $form->field($model, 'currencyIdFrom')->label("De")->dropDownList(
                    ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                );*/ ?>
                <?php /*echo $form->field($model, 'currencyIdTo')->label("A")->dropDownList(
                    ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                );*/ ?>
                <?= $form->field($model, 'exchangeId')->label("Conversion")->dropDownList(
                    ArrayHelper::map(ExchangeRate::find()->where(['status' => 1])->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                ) ?>
                <?= $form->field($model, 'amountFrom')->label("Monto a convertir") ?>
                
                <?= $form->field($model, 'accountAdminIdTo')->label("Cuenta a donde transfirió el dinero")->dropDownList(
                    ArrayHelper::map(AccountAdmin::find()->joinWith(['rates'])->where(['gaccounts_admin.status' => 1, 'gexchange_rates.status' => 1])->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                ) ?>
                
                <?= $form->field($model, 'clientBankTransaction')->label("Numero de Depósito o Transferencia") ?>
                
                <?= $form->field($model, 'accountClientId')->label("Banco para recibir la transaccion")->dropDownList(
                    ArrayHelper::map(AccountClient::find()->where(['clientId' => Yii::$app->user->identity->id])->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                )?>

                <?= $form->field($model, 'transactionDate')->label("Fecha de la transaccion")->widget(DatePicker::classname(), [
                    'language'      => 'es',
                    'dateFormat'    => 'dd-MM-yyyy',
                    'clientOptions' => [
                        'maxDate'      => '0',
                        'defaultValue' => date('dd-MM-yyyy'),
                    ],
                    'options'       => [
                        'class' => 'form-control',
                    ],
                ]) ?>
                
                <?= $form->field($model, 'uploadFile')->fileInput() ?>
                
                <div class="form-group">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'form-transaction-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
