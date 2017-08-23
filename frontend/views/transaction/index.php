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
                        return Html::a($model->created_at, ['update', 'id' => $model->id]);
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
                        return Html::a($model->amountFrom, ['update', 'id' => $model->id]);
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
                        return Html::a($model->amountTo, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Cuenta',
                    'attribute' => 'accountClientDescription',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->accountClient->description, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Número Dep/Transf',
                    'attribute' => 'clientBankTransaction',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->clientBankTransaction, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Fecha Dep/Transf',
                    'attribute' => 'transactionDate',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->transactionDate, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Estado',
                    'attribute' => 'status',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->status, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'class'          => ActionColumn::className(),
                    'template'       => '{update} {delete} {upload}',
                    'contentOptions' => ['style' => 'width: 80px;min-width: 80px'],
                ],
            ],
        ]); ?>
</div>
