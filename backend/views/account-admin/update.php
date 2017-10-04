<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Bank;
use common\models\Currency;
use yii\widgets\MaskedInput;

$this->title = 'Geknology';
?>
<div class="site-index">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Agregar Cuenta bancaria') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('<i class="fa fa-lg fa-plus-circle position-left"></i> Agregar Cuenta bancaria', ['create'], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat pl20 pr20">
                <?php $form = ActiveForm::begin(['id' => 'form-account-admin']); ?>
                <fieldset class="content-group">

                        <legend class="text-bold"><?= Html::encode('Información del banco') ?></legend>
                        <div class="form-group mb40">
                            <div class="row">
                                <div class="col-md-5">
                                    <?= $form->field($model, 'description')->label("Descripcion")->textInput(['autofocus' => true]) ?>
                                </div>
                                <div class="col-md-5">
                                    <?= $form->field($model, 'bankId')->label("Banco")->dropDownList(
                                        ArrayHelper::map(Bank::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                                    ) ?>
                                </div>
                                <div class="col-md-5">
                                    <?= $form->field($model, 'type')->label("Tipo de cuenta")->dropDownList([
                                        'ahorro' => 'Ahorro',
                                        'corriente'  => 'Corriente',
                                        'rut'  => 'Rut',
                                        'vista'  => 'Vista',
                                    ], ['class' => 'form-control']) ?>
                                </div>
                                <div class="col-md-5">
                                    <?= $form->field($model, 'currencyId')->label("Moneda")->dropDownList(
                                        ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                                    ) ?>
                                </div>
                                <div class="col-md-10">
                                    <?= $form->field($model, 'number')->label("Número de cuenta")->widget(MaskedInput::className(), [
                                        'mask' => '9999 9999 99 9999999999'
                                    ]) ?>
                                </div>
                            </div>
                        </div>

                        <legend class="text-bold"><?= Html::encode('Información del dueño de la cuenta') ?></legend>
                        <div class="form-group mb40">
                            <?= $form->field($model, 'name')->label("Nombre del dueño") ?>
                            <?= $form->field($model, 'lastname')->label("Apellido del dueño") ?>
                            <?= $form->field($model, 'rut')->label("Identificación del dueño") ?>
                            <?= $form->field($model, 'email')->label("Correo electrónico") ?>
                        </div>

                        <legend class="text-bold"><?= Html::encode('Información de las transacciones') ?></legend>
                        <div class="form-group mb40">
                            <?= $form->field($model, 'minAmount')->label("Cantidad mínima para transacciones") ?>
                            <?= $form->field($model, 'maxAmount')->label("Cantidad máxima para transacciones") ?>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Actualizar Cuenta Bancaria', ['class' => 'btn btn-primary', 'name' => 'form-account-admin-button']) ?>
                        </div>
                    </fieldset>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>