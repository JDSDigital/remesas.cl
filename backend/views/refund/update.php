<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;


$this->title = 'Geknology';
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Responder Devolución') ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <div class="row panel panel-flat">
            <div class="col-md-5 ml20">
                <?php $form = ActiveForm::begin(['id' => 'form-refund']); ?>
                 <?= $form->field($model, 'status')->label("Estado")->dropDownList([
                        '0' => 'Pendiente',
                        '1' => 'Rechazada',
                        '2' => 'Realizada'
                    ], ['class' => 'form-control']) ?>
                <?= $form->field($model, 'responseDate')->label("Fecha de la devolución")->widget(DatePicker::classname(), [
                         'language' => 'es',
                         'dateFormat' => 'dd-MM-yyyy',
                         'clientOptions' => [
                            'maxDate' => '0'
                         ]
                ])?>
                <?= $form->field($model, 'observation')->label("Observacion") ?>
                <div class="form-group">
                    <?= Html::submitButton('Responder', ['class' => 'btn btn-primary', 'name' => 'form-refund-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>