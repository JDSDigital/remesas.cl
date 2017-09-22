<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Currency;

/* @var $this yii\web\View */
/* @var $model common\models\AccountClient */

$this->title = 'Calculadora';
//$this->params['breadcrumbs'][] = ['label' => 'Account Clients', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container calculator">
    <div class="row">
        <div class="col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(['id' => 'form-account-client']); ?>
                <?= Html::label("Cantidad a convertir", "amount") ?>
                <?= Html::textInput('amount', $amount, ['class' => 'form-control']) ?>
                <?= Html::label("De", "currencyIdFrom") ?>
                <?= Html::dropDownList('currencyIdFrom', $model->currencyIdFrom, ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control'])?>
                <?= Html::label("A", "currencyIdTo") ?>
                <?= Html::dropDownList('currencyIdTo', $model->currencyIdTo, ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control'])?>
                
                <?php
                    if (isset($result) && $result != null){
                        echo Html::tag('h1', Html::encode($result), ['id' => 'result']); 
                    }
                ?>
                <div class="form-group">
                    <?= Html::submitButton('Calcular', ['class' => 'btn btn-primary mt10', 'name' => 'form-calculator-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
