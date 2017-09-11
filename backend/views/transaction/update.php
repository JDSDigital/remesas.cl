<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

use common\models\AccountAdmin;
use common\models\Country;

$this->title = 'Geknology';
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Modificar Transaccion') ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <div class="row panel panel-flat">
            <div class="col-md-5 ml20">
                <?php $form = ActiveForm::begin(['id' => 'form-transaction']); ?>
                <?= Html::label("Monto a convertir") ?>
                <?= Html::label($model->amountFrom." ".$model->currencyFrom->symbol) ?>
                <?= Html::label("De") ?>
                <?= Html::label($model->currencyFrom->name) ?>
                <?= Html::label("A") ?>
                <?= Html::label($model->currencyTo->name) ?>
                 <?= $form->field($model, 'status')->label("Estado")->dropDownList([
                        '0' => 'Pendiente',
                        '1' => 'Anulada',
                        '2' => 'Realizada'
                    ], ['class' => 'form-control']) ?>
                <div class="hideField">
                <?= $form->field($model, 'usedValue')->label("Tasa")->textInput((Yii::$app->user->identity->role != 'root') ? ['disabled' => 'true'] : []) ?>
                <?= $form->field($model, 'amountTo')->label("Monto convertido")->textInput((Yii::$app->user->identity->role != 'root') ? ['disabled' => 'true'] : []) ?>
                <?= $form->field($model, 'accountAdminIdFrom')->label("Cuenta desde donde transfirió el dinero")->dropDownList(
                    ArrayHelper::map(AccountAdmin::find()->where('status = 1 and currencyId = '.$model->currencyIdTo)->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                ) ?>
                <?= $form->field($model, 'adminBankTransaction')->label("Numero de Deposito o Transferencia") ?>
                <?= $form->field($model, 'transactionResponseDate')->label("Fecha de la transaccion")->widget(DatePicker::classname(), [
                         'language' => 'es',
                         'dateFormat' => 'dd-MM-yyyy',
                         'clientOptions' => [
                            'maxDate' => '0'
                         ]
                ])?>
                <?= $form->field($model, 'winnings')->label("Ganancia por esta transaccion") ?>
                </div>
                <?= $form->field($model, 'observation')->label("Observacion") ?>
                <div class="form-group">
                    <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'name' => 'form-transaction-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJs('hideFields();') ?>