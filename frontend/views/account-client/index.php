<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis Cuentas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Yii::$app->session->getFlash('success'); ?>
    <p>
        <?php
            // Allow adding a new account only if the Client has added less than three accounts
            if ($dataProvider->getTotalCount() < 3){      
                echo Html::a('Agregar Cuenta Bancaria', ['create'], ['class' => 'btn']); 
            } 
        ?>
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
                        return Html::a($model->type, ['update', 'id' => $model->id]);
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
</div>
