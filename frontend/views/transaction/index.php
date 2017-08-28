<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transacciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Yii::$app->session->getFlash('success'); ?>
    <p>
        <?= Html::a('Solicitar transacción', ['create'], ['class' => 'btn']) ?>
    </p>
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
                        return Yii::$app->formatter->asDate($model->created_at, 'dd-MM-yyyy');
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
                        return $model->amountFrom." ".$model->currencyFrom->symbol;
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
                    'label'     => 'Monto convertido aprox.',
                    'attribute' => 'amountTo',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return $model->amountTo." ".$model->currencyTo->symbol;
                    },
                ],
                [
                    'label'     => 'Cuenta',
                    'attribute' => 'accountClientDescription',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return $model->accountClient->description;
                    },
                ],
                [
                    'label'     => 'Número Dep/Transf',
                    'attribute' => 'clientBankTransaction',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return $model->clientBankTransaction;
                    },
                ],
                [
                    'label'     => 'Fecha Dep/Transf',
                    'attribute' => 'transactionDate',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Yii::$app->formatter->asDate($model->transactionDate, 'dd-MM-yyyy');
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
                    'class'          => ActionColumn::className(),
                    'template'       => '{view}',
                    'contentOptions' => ['style' => 'width: 80px;min-width: 80px'],
                    'buttons'=>[
                        'view' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id'=>$model->id],['title'=>'Ver detalle de transaccion']);
                        },
                     ], 
                ],
            ],
        ]); ?>
</div>
