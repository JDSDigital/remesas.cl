<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Bank;
use common\models\Currency;


$this->title = 'Geknology';
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Agregar Cuenta bancaria') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('Agregar Cuenta Bancaria', ['create'], ['class' => 'btn']) ?>
                </p>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <div class="row panel panel-flat">
            <div class="col-md-5 ml20">
                <?php $form = ActiveForm::begin(['id' => 'form-account-admin']); ?>
                    <?= $form->field($model, 'description')->label("Descripcion")->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'bankId')->label("Banco")->dropDownList(
                        ArrayHelper::map(Bank::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                    ) ?>
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
                    <?= $form->field($model, 'name')->label("Nombre del dueño") ?>
                    <?= $form->field($model, 'lastname')->label("Apellido del dueño") ?>
                    <?= $form->field($model, 'rut')->label("Identificación del dueño") ?>
                    <?= $form->field($model, 'email')->label("Correo electrónico") ?>
                    <?= $form->field($model, 'minAmount')->label("Cantidad mínima para transacciones") ?>
                    <?= $form->field($model, 'maxAmount')->label("Cantidad máxima para transacciones") ?>
                    
                    <div class="form-group">
                        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'name' => 'form-account-admin-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
