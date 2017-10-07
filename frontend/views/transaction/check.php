<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\CheckForm */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\CheckForm;
use common\models\ExchangeRate;

$model = new CheckForm();
$rates = ExchangeRate::find()->where(['status' => 1])->orderBy('description')->all();

?>

<div id="modal-check" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h1><?= Html::encode('Verificar disponibilidad') ?></h1>
                <?php $form = ActiveForm::begin([
                    'id'     => 'check-form',
                    'action' => ['check'],
                ]); ?>

                <?= $form->field($model, 'rate')->dropDownList(ArrayHelper::map($rates, 'id', 'description'), ['class' => 'form-control']) ?>

                <?= $form->field($model, 'amount')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Verificar', ['class' => 'btn btn-primary', 'name' => 'check-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>