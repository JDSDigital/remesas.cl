<?php

use kartik\widgets\FileInput;
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
            <?php $form = ActiveForm::begin([
                'id' => 'form-transaction',
                'action' => 'create',
            ]); ?>
                <?php /*echo $form->field($model, 'currencyIdFrom')->label("De")->dropDownList(
                    ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                );*/ ?>
                <?php /*echo $form->field($model, 'currencyIdTo')->label("A")->dropDownList(
                    ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                );*/ ?>
                <?= $form->field($model, 'exchangeId')->label("Conversion")->dropDownList(
                    ArrayHelper::map(ExchangeRate::find()->where(['and', 'currencyIdFrom' => Yii::$app->session['currencyIdFrom'], 'currencyIdTo' => Yii::$app->session['currencyIdTo']])->all(), 'id', 'description'), ['class' => 'form-control', 'disabled' => 'disabled']
                ) ?>
                <?= $form->field($model, 'exchangeId')->hiddenInput(['value' => Yii::$app->session['currencyIdFrom']])->label(false) ?>

                <?= $form->field($model, 'amountFrom')->label("Monto a convertir")->textInput(['value' => Yii::$app->session['amountFrom'], 'disabled' => 'disabled']) ?>
                <?= $form->field($model, 'amountFrom')->hiddenInput(['value' => Yii::$app->session['amountFrom']])->label(false) ?>

                <?= $form->field($model, 'accountAdminIdTo')->label("Cuenta a donde transfirió el dinero")->dropDownList(
                    ArrayHelper::map(AccountAdmin::find()->joinWith(['rates'])->where(['gaccounts_admin.status' => 1, 'gexchange_rates.status' => 1])->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                ) ?>
                
                <?= $form->field($model, 'clientBankTransaction')->label("Numero de Depósito o Transferencia") ?>
                
                <?= $form->field($model, 'accountClientId')->label("Cuenta en la cual desea recibir la transaccion")->dropDownList(
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
                
                <?= $form->field($model, 'uploadFile')->widget(FileInput::classname(), [
                    'name' => 'add-receipt',
                    'pluginOptions' => [
                        'allowedFileExtensions'=>['jpg'],
                        'maxFileSize'=>2800,
                        'showUpload' => false,
                        'showDelete' => true,
                        'previewFileType' => 'image',
                    ],
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-lg btn-primary', 'name' => 'form-transaction-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
