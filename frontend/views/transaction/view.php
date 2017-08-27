<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */

$this->title = "Transaccion #".$model->id;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'     => 'Estado',
                'value'     => function ($model) {
                                    $check = "Pendiente";
                                    
                                    if ($model->status == 1)
                                        $check = "Anulada";
                                    else if ($model->status == 2)
                                        $check = "Realizada";
                                    
                                    return $check;
                    },
            ],
            [                      
                'label' => 'Fecha',
                'value' => Yii::$app->formatter->asDate($model->created_at, 'dd-MM-yyyy'),
            ],
            [
                'label' => 'Conversion',
                'value' => $model->exchangeRate->description,
            ],
            [
                'label' => 'Monto a convertir',
                'value' => $model->amountFrom." ".$model->currencyFrom->symbol,
            ],
            [
                'label' => 'Tasa',
                'value' => $model->exchangeValue,
            ],
            [
                'label' => 'Monto convertido aprox.',
                'value' => $model->amountTo." ".$model->currencyTo->symbol,
            ],
            [
                'label'     => 'Cuenta',
                'value'     => $model->accountClient->description,
            ],
            [
                'label'     => 'Numero Dep/Transf',
                'value'     => $model->clientBankTransaction,
            ],
            [
                'label'     => 'Fecha Dep/Transf',
                'value'     => Yii::$app->formatter->asDate($model->transactionDate, 'dd-MM-yyyy'),
            ],
            [
                'label'     => 'Observacion',
                'value'     => $model->observation,
            ]            
        ],
    ]) ?>

</div>
