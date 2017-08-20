<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExchangeRateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geknology';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Tasas de Cambio') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('Agregar Tasa de Cambio', ['create'], ['class' => 'btn']) ?>
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
                    'label'     => 'De',
                    'attribute' => 'currencyNameFrom',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->currencyFrom->name, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'A',
                    'attribute' => 'currencyNameTo',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->currencyTo->name, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Tasa',
                    'attribute' => 'value',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->value, ['update', 'id' => $model->id]);
                    },
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
