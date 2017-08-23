<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

use common\models\AccountClient;
use common\models\ExchangeRate;


/* @var $this yii\web\View */
/* @var $model common\models\AccountClient */

$this->title = 'Registrar Depósito / Transferencia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-client-create">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-transaction']); ?>
                <?= $form->field($model, 'exchangeId')->label("Conversion")->dropDownList(
                    ArrayHelper::map(ExchangeRate::find()->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                ) ?>
            
                <?= $form->field($model, 'amountFrom')->label("Monto a convertir") ?>
                
                <?= $form->field($model, 'accountClientId')->label("Desde el banco")->dropDownList(
                    ArrayHelper::map(AccountClient::find()->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                ) ?>
                
                <?= $form->field($model, 'clientBankTransaction')->label("Numero de Depósito o Transferencia") ?>
                
                <?= $form->field($model, 'transactionDate')->widget(DatePicker::classname(), [
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
