<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

use common\models\AccountAdmin;
use common\models\AccountClient;
use common\models\Currency;


/* @var $this yii\web\View */
/* @var $model common\models\AccountClient */

$this->title = 'Registrar Depósito / Transferencia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-client-create">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-transaction']); ?>
                <?= $form->field($model, 'currencyIdFrom')->label("De")->dropDownList(
                    ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                ) ?>
                <?= $form->field($model, 'currencyIdTo')->label("A")->dropDownList(
                    ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                ) ?>
                <?= $form->field($model, 'amountFrom')->label("Monto a convertir") ?>
                
                <?= $form->field($model, 'accountAdminId')->label("Cuenta a donde transfirió el dinero")->dropDownList(
                    ArrayHelper::map(AccountAdmin::find()->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                ) ?>
                
                <?= $form->field($model, 'clientBankTransaction')->label("Numero de Depósito o Transferencia") ?>
                
                <?= $form->field($model, 'accountClientId')->label("Banco para recibir la transaccion")->dropDownList(
                    ArrayHelper::map(AccountClient::find()->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                )?>
                
                <?= $form->field($model, 'transactionDate')->label("Fecha de la transaccion")->widget(DatePicker::classname(), [
                         'language' => 'es',
                         'dateFormat' => 'dd-MM-yyyy',
                ])?>
                
                <div class="form-group">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'form-transaction-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
