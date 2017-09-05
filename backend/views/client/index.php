<?php

use yii\helpers\Html;

use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options'        => [
            'class' => 'panel panel-flat pl20 pr20',
        ],
        'tableOptions'   => [
            'class' => 'table table-striped table-hover',
        ],
        'summaryOptions' => [
            'class' => 'mt20 mb20 ml5',
        ],
        'columns' => [
            [
                'label'     => 'Nombre',
                'attribute' => 'displayName'
            ],
            [
                'label'     => 'Identificacion',
                'attribute' => 'rut'
            ],
            [
                'label'     => 'Telefono',
                'attribute' => 'phone'
            ],
            [
                'label'     => 'Correo electronico',
                'attribute' => 'email'
            ],
            [
                'label'     => 'Estado',
                'attribute' => 'status',
                'format'    => 'raw',
                'value'     => function ($model) {
                                $check = ($model->status == 1) ? "Activo" : "Inactivo";
        
                                return $check;
                            },
            ],
            [
                'label'     => 'Bloqueado',
                'attribute' => 'blocked',
                'format'    => 'raw',
                'value'     => function ($model) {
                                $check = ($model->blocked == 1) ? "checked='checked'" : null;
        
                                return "<div class='switchery-xs m0'>
                                            <input id='blocked-$model->id' type='checkbox' class='switchery switchBlocked' $check>
                                        </div>";
                            },
            ],
            [
                'class'          => ActionColumn::className(),
                'template'       => '{transactions} {accounts}',
                'contentOptions' => ['style' => 'width: 80px;min-width: 80px'],
                'buttons'=>[
                    'accounts' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-user"></span>', ['accounts', 'id'=>$model->id],['title'=>'Ver cuentas bancarias del usuario']);
                    }
                 ],
            ],
        ],
    ]); ?>
</div>
<?php $this->registerJs('listenerChangeBlocked();') ?>