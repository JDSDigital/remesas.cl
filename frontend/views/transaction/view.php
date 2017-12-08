<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Transaction;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */

$this->title = "Transaccion #".$model->id;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container transaction-view pt30">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'label'     => 'Estado',
                        'value'     => function ($model) {
                            $check = "Pendiente";

                            if ($model->status == Transaction::STATUS_CANCELLED)
                                $check = "Anulada";
                            else if ($model->status == Transaction::STATUS_DONE)
                                $check = "Realizada";

                            return $check;
                        },
                    ],
                    [
                        'label' => 'Fecha',
                        'value' => Yii::$app->formatter->asDate($model->created_at, 'dd-MM-yyyy'),
                    ],
                    [
                        'label' => 'De',
                        'value' => $model->currencyFrom->name,
                    ],
                    [
                        'label' => 'A',
                        'value' => $model->currencyTo->name,
                    ],
                    [
                        'label' => 'Monto a convertir',
                        'value' => Yii::$app->formatter->asCurrency($model->amountFrom, $model->currencyFrom->symbol),
                    ],
                    [
                        'label' => 'Tasa',
                        'value' => $model->usedValue,
                    ],
                    [
                        'label' => 'Monto convertido aprox.',
                        'value' => Yii::$app->formatter->asCurrency($model->amountTo, $model->currencyTo->symbol),
                    ],
                    [
                        'label'     => 'Cuenta',
                        'value'     => $model->accountClient->description,
                    ],
                    [
                        'label'     => 'Nombre de la persona que realizó la transferencia',
                        'value'     => $model->userNameTransaction,
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
                        'value'     => ($model->observation != "") ? $model->observation : "---",
                    ],
                    [
                        'label'     => 'Tranferencias',
                        'format'    => 'raw',
                        'value'     => function ($model){
                                            $transactions = $model->transactionParts;
                                            $list_transactions = "";
                                            
                                            if (sizeof($transactions) > 0){
                                                $list_transactions = "<ul>";
                                                foreach($transactions as $t){
                                                    $list_transactions.= "<li>Desde ".$t->accountAdminFrom->bank->name." (".$t->adminBankTransaction.") . ".$t->amountTo." ".$model->currencyTo->symbol." </li>";
                                                }
                                                $list_transactions.= "</ul>";
                                            }
                                            else {
                                                $list_transactions = "---";
                                            }
            
                                            return $list_transactions;
                                       },
                    ]
                ],
            ]) ?>
        </div>
    </div>
</div>
