<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Bank;
use common\models\Country;
use common\models\Currency;

/* @var $this yii\web\View */
/* @var $model common\models\AccountClient */

$this->title = 'Crear cuenta bancaria';
$this->params['breadcrumbs'][] = ['label' => 'Account Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-client-create">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-account-client']); ?>
                <?= $form->field($model, 'description')->label("Descripcion")->textInput(['autofocus' => true]) ?>
                <?= Html::label("País") ?>
                <?= Html::dropDownList('countryId', $countryId, ArrayHelper::map(Country::find()->orderBy('name')->all(), 'id', 'name'), 
                                      [
                                        'id' => 'countryId',
                                        'class' => 'form-control',
                                        'onchange'=>'
                                                $.post( "listb?id="+$(this).val(), function( data ) {
                                                  $( "#accountclient-bankid" ).html( data );
                                                });'
                                      ]) 
                ?>
                <?= $form->field($model, 'bankId')->label("Banco")->dropDownList(ArrayHelper::map(Bank::find()->all(), 'id', 'name'), ['class' => 'form-control']); ?> 
                <?= $form->field($model, 'type')->label("Tipo de cuenta")->dropDownList([
                    'ahorro' => 'Ahorro',
                    'corriente'  => 'Corriente',
                    'rut'  => 'Rut',
                    'vista'  => 'Vista',
                ], ['class' => 'form-control']) ?>
                <?= $form->field($model, 'currencyId')->label("Moneda")->dropDownList(
                    ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                ) ?>
                <?= $form->field($model, 'number')->label("Número de cuenta") ?>
                
                <div class="form-group">
                    <?= Html::submitButton('Crear Cuenta Bancaria', ['class' => 'btn btn-primary', 'name' => 'form-account-client-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
