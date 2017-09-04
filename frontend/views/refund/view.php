<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Refund */

$this->title = "Solicitud de devolución #".$model->id." - Transacción #".$model->transactionId;
$this->params['breadcrumbs'][] = ['label' => 'Refunds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refund-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'     => 'Estado',
                'value'     => function ($model) {
                                    $check = "Pendiente";
                                    
                                    if ($model->status == 1)
                                        $check = "Rechazada";
                                    else if ($model->status == 2)
                                        $check = "Realizada";
                                    
                                    return $check;
                    },
            ],
            [                      
                'label' => 'Fecha',
                'value' => Yii::$app->formatter->asDate($model->created_at, 'dd-MM-yyyy'),
            ],
            [
                'label' => 'Transacción',
                'value' => Html::a("# ".$model->transactionId, ['/transaction/view', 'id' => $model->id]),
                'format' => 'html'
            ],
            [
                'label' => 'Motivos',
                'value' => $model->motivation,
            ]           
        ],
    ]) ?>

</div>
