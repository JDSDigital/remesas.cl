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

$this->title = 'Paso 1: Verificar Disponibilidad';

?>

<div class="site-index container pt30">
    <div class="row">
        <div class="col-lg-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-calculator-client']); ?>
                <?= Html::label("De", "currencyIdFrom") ?>
                <?= Html::dropDownList('currencyIdFrom', $model->currencyIdFrom, ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['id' => 'currencyIdFrom', 'class' => 'form-control'])?>
                <?= Html::label("A", "currencyIdTo") ?>
                <?= Html::dropDownList('currencyIdTo', $model->currencyIdTo, ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['id' => 'currencyIdTo', 'class' => 'form-control'])?>
                <?= Html::label("Cantidad a convertir", "amount") ?>
                <?= Html::textInput('amount', $amount, ['id' => 'amount', 'class' => 'form-control', 'style' => 'text-align: right']) ?>

                <?php
                if (isset($result) && $result != null){
                    echo Html::tag('h1', Yii::$app->formatter->asCurrency(Html::encode($result)), ['id' => 'result']);
                }
                ?>
                <h1 id="result"></h1>
                <div class="form-group">
                    <?= Html::button('Calcular', ['class' => 'btn btn-lg btn-primary mt10', 'id' => 'form-calculator-button', 'url' => Yii::$app->request->baseUrl . '/site/calculator']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <?= Html::a('Continuar', ['//account-client/index'], ['id' => 'btn-continue', 'class' => 'btn btn-lg btn-success mb30 hidden'])?>
        </div>
    </div>
</div>