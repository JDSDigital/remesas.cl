<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geknology';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Bancos') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('Agregar Banco', ['create'], ['class' => 'btn']) ?>
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
                    'label'     => 'Nombre',
                    'attribute' => 'name',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->name, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'label'     => 'Pais',
                    'attribute' => 'countryName',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->getCountryName(), ['update', 'id' => $model->id]);
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
