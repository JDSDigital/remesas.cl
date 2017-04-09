<?php

/* @var $this yii\web\View */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;


$this->title = 'Geknology';
?>
<div class="site-index">
    <div class="page-header no-border mb0">
        <div class="page-header-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-title">
                        <h3><?= Html::encode('Usuarios') ?></h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="text-right mt35 mb30">
                        <?= Html::a('<i class="icon-user-plus mr5"></i>' . Html::encode('Agregar Usuario'), ['create']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
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
                    'attribute' => 'username',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->username, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'attribute' => 'email',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->email, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'attribute' => 'status',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return Html::a($model->status, ['update', 'id' => $model->id]);
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
