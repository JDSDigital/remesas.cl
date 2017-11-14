<?php

/* @var $this yii\web\View */

use common\models\Bank;
use common\models\Refund;
use common\models\Transaction;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;


$this->title = 'Geknology';
?>
<div class="site-index">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Transacciones Pendientes') ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <?= Yii::$app->session->getFlash('success'); ?>

        <?php if (Yii::$app->user->identity->role == 'admin' || Yii::$app->user->identity->role == 'root'){ 
        
            echo GridView::widget([
                'dataProvider'   => $dataProvider,
                'layout'         => '{items}{pager}{summary}',
                'options'        => [
                    'class' => 'panel panel-flat pl20 pr20',
                ],
                'tableOptions'   => [
                    'class' => 'table table-striped table-hover',
                ],
                'summaryOptions' => [
                    'class' => 'mt20 mb20 ml5',
                ],
                'columns'        => [
                    [
                        'label'     => 'Fecha',
                        'attribute' => 'created_at',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Yii::$app->formatter->asDate($model->created_at, 'dd-MM-yyyy');
                        },
                    ],
                    [
                        'label'     => 'Cliente',
                        'attribute' => 'clientName',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return $model->client->name." ".$model->client->lastName;
                        },
                    ],
                    [
                        'label'     => 'De',
                        'attribute' => 'currencyNameFrom',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return $model->currencyFrom->name;
                        },
                    ],
                    [
                        'label'     => 'A',
                        'attribute' => 'currencyNameTo',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return $model->currencyTo->name;
                        },
                    ],
                    [
                        'label'     => 'Monto a convertir',
                        'attribute' => 'amountFrom',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Yii::$app->formatter->asCurrency($model->amountFrom, $model->currencyFrom->symbol);
                        },
                    ],
                    [
                        'label'     => 'Tasa',
                        'attribute' => 'usedValue',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return $model->usedValue;
                        },
                    ],
                    [
                        'label'     => 'Monto convertido',
                        'attribute' => 'amountTo',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return ($model->amountTo != "") ? Yii::$app->formatter->asCurrency($model->amountTo, $model->currencyTo->symbol) : "---";
                        },
                    ],
                    [
                        'label'     => 'Desde la cuenta',
                        'attribute' => 'accountAdminDescFrom',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return ($model->accountAdminIdFrom != null && $model->accountAdminFrom->description != "") ? $model->accountAdminFrom->description : "---";
                        },
                    ],
                    [
                        'label'     => 'Ganancia',
                        'attribute' => 'winnings',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return ($model->winnings != "") ? Yii::$app->formatter->asCurrency($model->winnings, 'CLP') : "---";
                        },
                    ],
                    [
                        'label'     => 'Fecha Cierre',
                        'attribute' => 'transactionResponseDate',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Yii::$app->formatter->asDate($model->transactionResponseDate, 'dd-MM-yyyy');
                        },
                    ],
                    [
                        'label'     => 'Estado',
                        'attribute' => 'status',
                        'format'    => 'raw',
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
                        'label'     => 'Solicitud de devolución',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            if ($model->refund){
                                return 'Si';
                            }
                            else
                                return 'No';
                        },
                    ],
                    /*[
                        'class'          => ActionColumn::className(),
                        'template'       => '{update} {receipt} {account_data}',
                        'contentOptions' => ['style' => 'width: 80px;min-width: 80px'],
                        'buttons'=>[
                            'receipt' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['#'],['title'=>'Ver recibo de la transaccion', 'id' => 'modalButton', 't' =>$model->id, 'route' => Yii::$app->urlManagerFrontend->createUrl('/uploads/t-'.$model->id.'.jpg')]);
                            },
                            'account_data' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-user"></span>', ['/client/accounts', 'id'=>$model->clientId, 'acc' => $model->accountClientId],['title'=>'Ver datos de la cuenta bancaria del usuario']);
                            }
                        ],
                    ],*/
                ],
            ]); 
        }
        else {
            echo GridView::widget([
                'dataProvider'   => $dataProvider,
                'layout'         => '{items}{pager}{summary}',
                'options'        => [
                    'class' => 'panel panel-flat pl20 pr20 table-responsive',
                ],
                'tableOptions'   => [
                    'class' => 'table table-striped table-hover',
                ],
                'summaryOptions' => [
                    'class' => 'mt20 mb20 ml5',
                ],
                'columns'        => [
                    [
                        'label'     => 'Fecha',
                        'attribute' => 'created_at',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a(Yii::$app->formatter->asDate($model->created_at, 'dd-MM-yyyy'), ['update', 'id' => $model->id]);
                        },
                    ],
                    [
                        'label'     => 'Banco',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a(Bank::findOne(['id' => $model->accountClient->bankId])->name, ['update', 'id' => $model->id]);
                        },
                    ],
                    [
                        'label'     => 'Titular',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a($model->accountClient->description, ['update', 'id' => $model->id]);
                        },
                    ],
                    [
                        'label'     => 'RUT/Cédula',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a($model->accountClient->rut, ['update', 'id' => $model->id]);
                        },
                    ],
                    [
                        'label'     => 'Número de Cuenta',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a($model->accountClient->number, ['update', 'id' => $model->id]);
                        },
                    ],
                    [
                        'label'     => 'Monto a transferir',
                        'attribute' => 'amountTo',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a(($model->amountTo != "") ? Yii::$app->formatter->asCurrency($model->amountTo, $model->currencyTo->symbol) : "---", ['update', 'id' => $model->id]);
                        },
                    ],
                    [
                        'label'     => 'Correo',
                        'attribute' => 'amountTo',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Html::a($model->client->email, ['update', 'id' => $model->id]);
                        },
                    ],
                    [
                        'label'     => 'Fecha Cierre',
                        'attribute' => 'transactionResponseDate',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return Yii::$app->formatter->asDate($model->transactionResponseDate, 'dd-MM-yyyy');
                        },
                    ],
                    [
                        'label'     => 'Estado',
                        'attribute' => 'status',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            $check = "Pendiente";

                            if ($model->status == Transaction::STATUS_CANCELLED)
                                $check = "Anulada";
                            else if ($model->status == Transaction::STATUS_DONE)
                                $check = "Realizada";

                            return Html::a($check, ['update', 'id' => $model->id]);
                        },
                    ],
                ],
            ]);
        }
        ?>
    </div>
</div>
