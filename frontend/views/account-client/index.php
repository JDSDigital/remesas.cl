<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paso 2: Agregar Cuentas';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container account-client-index pt30">
    <div class="row">
    	<div class="col-md-6 text-left">
            <h1><?= Html::encode($this->title) ?></h1>
            <h4>Cuentas donde usted recibirá el dinero solicitado.</h4>
        </div>
    	<div class="col-md-6 text-right">
            <p>
                <?php
                    // Allow adding a new account only if the Client has added less than three accounts
                    if ($dataProvider->getTotalCount() < 3){
                        echo Html::a('Agregar Cuenta Bancaria', ['create'], ['class' => 'btn btn-lg btn-primary']);
                    }
                ?>
            </p>
        </div>
    </div>
    <?= Yii::$app->session->getFlash('success'); ?>
    <?= GridView::widget([
            'dataProvider'   => $dataProvider,
            'layout'         => '{items}{pager}{summary}',
            'options'        => [
                'class' => 'panel panel-flat',
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
                    'attribute' => 'rut',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->rut, ['update', 'id' => $model->id]);
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
                    'class'          => ActionColumn::className(),
                    'template'       => '{update} {delete}',
                    'contentOptions' => ['style' => 'width: 80px;min-width: 80px'],
                ],
            ],
        ]); ?>
    <div class="row">
        <div class="col-lg-12 text-center">
            <?= Html::a('Continuar', ['//site/accounts'], ['id' => 'btn-continue', 'class' => 'btn btn-lg btn-success mb30 ' . ($dataProvider->getTotalCount() == 0 ? 'hidden' : '')])?>
        </div>
    </div>
</div>
