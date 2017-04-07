<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;


$this->title = 'Geknology';
?>
<div class="site-index">
    <div class="page-header no-border mb0">
        <div class="page-header-content">
            <div class="page-title pb0">
                <h3><?= Html::encode('Usuarios') ?></h3>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'layout'       => '{items}{pager}{summary}',
                'options'      => [
                    'class' => 'panel panel-flat p20',
                ],
                'tableOptions' => [
                    'class' => 'table table-striped table-hover',
                ],
                'summaryOptions' => [
                    'class' => 'mt20 mb20 ml5',
                ],
                'columns' => [
                    [
                        'attribute' => 'username',
                    ],
                    [
                        'attribute' => 'email',
                    ],
                    [
                        'attribute' => 'status',
                    ],
                ],
            ]);
        ?>
    </div>
</div>
