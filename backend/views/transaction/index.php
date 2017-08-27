<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geknology';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index panel">
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
                    'label'     => 'Conversión',
                    'attribute' => 'exchangeRateDescription',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->exchangeRate->description, ['update', 'id' => $model->id]);
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
                    'attribute' => 'exchangeValue',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->exchangeValue, ['update', 'id' => $model->id]);
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
                    'class'          => ActionColumn::className(),
                    'template'       => '{update}',
                    'contentOptions' => ['style' => 'width: 80px;min-width: 80px'],
                ],
            ],
        ]); ?>
    </div>
</div>
