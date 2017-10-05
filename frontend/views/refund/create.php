<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Refund */

$this->title = 'Solicitar Devolución - Transacción '.$t;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-refund']); ?>
                
                <?= $form->field($model, 'transactionId')->hiddenInput(['value' => $t])->label(false) ?>
                <?= $form->field($model, 'motivation')->label("Describa el motivo por el cual desea una devolución") ?>
                
                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'form-transaction-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
