<?php

use common\models\Currency;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

use common\models\Transaction;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geknology';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Cuentas bancarias') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('<i class="fa fa-lg fa-plus-circle position-left"></i> Agregar Cuenta bancaria', ['create'], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="panel panel-flat p15 mr40 ml40">
                <table class="table">
                    <tr>
                        <th class="text-center" colspan="2"><h3>Total restante</h3></th>
                    </tr>
                    <?php
                        $transaction = new Transaction();
                        foreach (Currency::find()->asArray()->all() as $currency) :
                    ?>
                        <tr>
                            <td align="right">
                                <b><?= $currency['name'] ?>:</b>
                            </td>
                            <td>
                                <?= Yii::$app->formatter->asCurrency($transaction->getTotal()[$currency['id']] - $transaction->getTransactionSumByCurrency($currency['id']), $currency['symbol']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    <!-- /page header -->
    <div class="panel panel-flat">
        <?= Yii::$app->session->getFlash('success'); ?>
        <?=
        GridView::widget([
            'dataProvider'   => $dataProvider,
            'layout'         => '{items}{pager}{summary}',
            'options'        => [
                'class' => 'pl20 pr20',
            ],
            'tableOptions'   => [
                'class' => 'table table-striped table-hover',
            ],
            'summaryOptions' => [
                'class' => 'mt20 mb20 ml5',
            ],
            'columns'        => [
                [
                    'label'     => 'Descripcion',
                    'attribute' => 'description',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->description, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Banco',
                    'attribute' => 'bankName',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->bank->name, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Tipo',
                    'attribute' => 'type',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a(ucfirst($model->type), ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Moneda',
                    'attribute' => 'currencyName',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->currency->name, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Cantidad Minima',
                    'attribute' => 'minAmount',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a(Yii::$app->formatter->asCurrency($model->minAmount, $model->currency->symbol), ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Cantidad Maxima',
                    'attribute' => 'maxAmount',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a(Yii::$app->formatter->asCurrency($model->maxAmount, $model->currency->symbol), ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Cantidad Restante',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                                // Calculate de available amount for this account
                                $transaction = new Transaction();
                                $total = $transaction->getTransactionSumByAA($model->id);
                                
                                if ($total['total'] != null)
                                    $rest = $model->maxAmount - $total['total'];
                                else 
                                    $rest = $model->maxAmount;
                        
                                return Html::a(Yii::$app->formatter->asCurrency($rest, $model->currency->symbol), ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Estado',
                    'attribute' => 'status',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        $check = ($model->status == 1) ? "checked='checked'" : null;

                        return "<div class='switchery-xs m0'>
                                    <input id='status-$model->id' type='checkbox' class='switchery switchStatusER' $check>
                                </div>";
                    }
                ],
                [
                    'class'          => ActionColumn::className(),
                    'template'       => '{update} {delete}',
                    'contentOptions' => ['style' => 'width: 80px;min-width: 80px'],
                ],
            ],
        ]);
        ?>
    </div>
</div>
<?php $this->registerJs('listenerChangeStatusER();') ?>