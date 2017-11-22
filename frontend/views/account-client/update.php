<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Bank;
use common\models\Country;
use common\models\Currency;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\AccountClient */

$this->title = 'Crear cuenta bancaria';
//$this->params['breadcrumbs'][] = ['label' => 'Account Clients', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container account-client-create pt30">
    <div class="row">
        <div class="col-lg-5">
            <h1>Modificar Cuenta</h1>
            <?php $form = ActiveForm::begin(['id' => 'form-account-client']); ?>
                <?= $form->field($model, 'description')->label("Titular de la cuenta")->textInput(['autofocus' => true]) ?>
                <?= Html::label("País") ?>
                <?= Html::dropDownList('countryId', $countryId, ArrayHelper::map(Country::find()->orderBy('name')->all(), 'id', 'name'), 
                                      [
                                        'id' => 'countryId',
                                        'class' => 'form-control',
                                        'onchange'=>'
                                                $.post( "listb?id="+$(this).val(), function( data ) {
                                                  $( "#accountclient-bankid" ).html( data );
                                                });
                                                if (this.value == 1) {
                                                    $("#accountclient-currencyid").val(1);
                                                } else if (this.value == 2) {
                                                    $("#accountclient-currencyid").val(2);
                                                };'
                                      ]) 
                ?>
                <?= $form->field($model, 'bankId')->label("Banco")->dropDownList(ArrayHelper::map(Bank::find()->all(), 'id', 'name'), ['class' => 'form-control']); ?>
                <?= $form->field($model, 'rut')->label("RUT/Cédula") ?>
                <?= $form->field($model, 'type')->label("Tipo de cuenta")->dropDownList([
                    'ahorro' => 'Ahorro',
                    'corriente'  => 'Corriente',
                    'rut'  => 'Rut',
                    'vista'  => 'Vista',
                ], ['class' => 'form-control']) ?>
                <?= $form->field($model, 'currencyId')->label("Moneda")->dropDownList(
                    ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                ) ?>
                <?= $form->field($model, 'number')->label("Número de cuenta")->widget(MaskedInput::className(), [
                    'mask' => '9999 9999 99 9999999999'
                ]) ?>
                
                <div class="form-group">
                    <?= Html::submitButton('Actualizar Cuenta Bancaria', ['class' => 'btn btn-primary', 'name' => 'form-account-client-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
