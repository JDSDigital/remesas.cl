<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geknology';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Cuentas bancarias') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('Agregar Cuenta bancaria', ['create'], ['class' => 'btn']) ?>
                </p>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <?= Yii::$app->session->getFlash('success'); ?>
        <?=
        GridView::widget([
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
                        return Html::a($model->minAmount, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Cantidad Maxima',
                    'attribute' => 'maxAmount',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->maxAmount, ['update', 'id' => $model->id]);
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