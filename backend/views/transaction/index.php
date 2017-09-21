<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use common\models\Refund;
//use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geknology';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Transacciones') ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <?= Yii::$app->session->getFlash('success'); ?>
        
        <?php 
            /*Modal::begin([
                'header' => 'Comprobante',
                'id' => 'modal',
                'size' => 'modal-lg'            
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();*/
        ?>
        
        <?= GridView::widget([
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
                        return Html::a(Yii::$app->formatter->asDate($model->created_at, 'dd-MM-yyyy'), ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Cliente',
                    'attribute' => 'clientName',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->client->name." ".$model->client->lastName, ['update', 'id' => $model->id]);
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
                        return Html::a($model->amountFrom." ".$model->currencyFrom->symbol, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Tasa',
                    'attribute' => 'usedValue',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->usedValue, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Monto convertido',
                    'attribute' => 'amountTo',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a(($model->amountTo != "") ? $model->amountTo." ".$model->currencyTo->symbol : "---", ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Desde la cuenta',
                    'attribute' => 'accountAdminDescFrom',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a(($model->accountAdminIdFrom != null && $model->accountAdminFrom->description != "") ? $model->accountAdminFrom->description : "---", ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Ganancia',
                    'attribute' => 'winnings',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a(($model->winnings != "") ? $model->winnings." CLP" : "---", ['update', 'id' => $model->id]);
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
                                    
                                    return Html::a($check, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Solicitud de devolución',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                                    // Check if there's a refunding petition made
                                    $refund = Refund::find()->where(['transactionId' => $model->id])->one();
                                    
                                    if ($refund){
                                       return Html::a('Si', ['/refund/update', 'id'=>$refund->id],['title'=>'Ver solicitud de devolucion']);   
                                    }
                                    else 
                                        return "No";
                    },
                ],
                [
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
                ],
            ],
        ]); ?>
    </div>
</div>
