<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Client */

$this->title = "Cuentas de ".$model->name." ".$model->lastName;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Nombre y Apellido',
                'value' => $model->name." ".$model->lastName,
            ],
            [
                'label' => 'Rut',
                'value' => $model->rut,
            ],
            [
                'label' => 'Correo electrónico',
                'value' => $model->email,
            ],
        ],
    ]) ?>
    
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
                    'label'     => 'Banco',
                    'attribute' => 'bank'
                ],
                [
                    'label'     => 'Número de cuenta',
                    'attribute' => 'number'
                ],
                [
                    'label'     => 'Tipo de cuenta',
                    'attribute' => 'type'
                ]
            ],
        ]); ?>

</div>
