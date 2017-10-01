<?php

use common\models\ExchangeRate;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Currency;

/* @var $this yii\web\View */
/* @var $model common\models\AccountClient */

$model = new ExchangeRate();
$result = null;
$amount = 1;

$this->title = 'Calculadora';
?>

<div id="modal-calculator" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h1><?= Html::encode($this->title) ?></h1>
                <?php $form = ActiveForm::begin(['id' => 'form-account-client']); ?>
                <?= Html::label("Cantidad a convertir", "amount") ?>
                <?= Html::textInput('amount', $amount, ['id' => 'amount', 'class' => 'form-control']) ?>
                <?= Html::label("De", "currencyIdFrom") ?>
                <?= Html::dropDownList('currencyIdFrom', $model->currencyIdFrom, ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['id' => 'currencyIdFrom', 'class' => 'form-control'])?>
                <?= Html::label("A", "currencyIdTo") ?>
                <?= Html::dropDownList('currencyIdTo', $model->currencyIdTo, ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['id' => 'currencyIdTo', 'class' => 'form-control'])?>

                <?php
                if (isset($result) && $result != null){
                    echo Html::tag('h1', Html::encode($result), ['id' => 'result']);
                }
                ?>
                <h1 id="result"></h1>
                <div class="form-group">
                    <?= Html::button('Calcular', ['class' => 'btn btn-primary mt10', 'id' => 'form-calculator-button', 'url' => Yii::$app->request->baseUrl . '/site/calculator']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>