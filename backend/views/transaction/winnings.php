<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'Geknology';
?>
<div class="site-index">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Reporte de Ganancias') ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-flat pl20 pr20">
                <?php $form = ActiveForm::begin(['id' => 'form-transaction']); ?>
                <?= Html::label("Inicio") ?>
                <?= DatePicker::widget([
                         'name' => 'startDate',   
                         'language' => 'es',
                         'dateFormat' => 'dd-MM-yyyy',
                         'value' => $startDate,
                         'clientOptions' => [
                            'maxDate' => '0'
                         ],
                         'options' => ['class' => 'form-control'],
                ]) ?>
                <?= Html::label("Fin") ?>
                <?= DatePicker::widget([
                         'name' => 'endDate',   
                         'language' => 'es',
                         'dateFormat' => 'dd-MM-yyyy',
                         'value' => $endDate,
                         'clientOptions' => [
                            'maxDate' => '0'
                         ],
                         'options' => ['class' => 'form-control'],
                ]) ?>
                <?= Html::label("Estado") ?>
                <?= Html::dropDownList('status', $status, [
                                                            ''  => 'Todas',
                                                            '0' => 'Pendiente',
                                                            '1' => 'Anulada',
                                                            '2' => 'Realizada'
                                                        ], 
                                      [ 'class' => 'form-control' ]) 
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Generar reporte', ['class' => 'btn btn-primary mt10', 'name' => 'form-transaction-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="winningsReport">
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
                            return Yii::$app->formatter->asCurrency($model->amountFrom)." ".$model->currencyFrom->symbol;
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
                            return Yii::$app->formatter->asCurrency($model->amountTo)." ".$model->currencyTo->symbol;
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
                        'label'     => 'Ganancia',
                        'attribute' => 'winnings',
                        'format'    => 'raw',
                        'value'     => function ($model) {
                            return ($model->winnings != "") ? Yii::$app->formatter->asCurrency($model->winnings)." CLP" : "---";
                        },
                    ],
                ],
            ]); ?>
            </div>
        </div>

        <?php
            if (isset($total) && $total != ""){
                echo Html::tag('h3', "Total ".Html::encode($total)." CLP");
            }
        ?>
    </div>
</div>
backend/views/account-admin/create.php backend/views/account-admin/update.php backend/views/transaction/index.php backend/views/transaction/winnings.php common/config/main.php common/models/Transaction.php frontend/views/account-client/create.php frontend/views/account-client/update.php frontend/views/transaction/create.php