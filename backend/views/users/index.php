<?php

/* @var $this yii\web\View */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;


$this->title = 'Geknology';
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Usuarios') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('<i class="icon-user-plus mr5"></i>' . Html::encode('Agregar Usuario'), ['create'])?>
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
                        $check = ($model->status == 1) ? "checked='checked'" : null;
                        $_csrf = Yii::$app->request->getCsrfToken();
                        $disabled = ($model->id == 1) ? 'disabled' : '';

                        return "<div class='switchery-xs m0'>
                                    <input id='status-$model->id' type='checkbox' class='switchery switchStatus' _csrf='$_csrf' $check $disabled>
                                </div>";
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
<?php $this->registerJs('listenerChangeStatus();') ?>