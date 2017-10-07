<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Client */

$this->title = "Cuentas de ".$model->name." ".$model->lastName;
//$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-6">
            <div class="panel panel-flat pt0">
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
            </div>
        </div>
    </div>

    <div class="panel panel-flat">
        <?= GridView::widget([
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
                    'label'     => 'Banco',
                    'attribute' => 'bank'
                ],
                [
                    'label'     => 'Número de cuenta',
                    'attribute' => 'number'
                ],
                [
                    'label'     => 'RUT/Cédula',
                    'attribute' => 'rut'
                ],
                [
                    'label'     => 'Tipo de cuenta',
                    'attribute' => 'type'
                ]
            ],
        ]); ?>
    </div>

</div>
