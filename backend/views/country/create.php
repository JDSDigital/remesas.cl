<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Geknology';
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Agregar Pais') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('<i class="fa fa-lg fa-plus-circle position-left"></i> Agregar Pa&iacute;s', ['create'], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <div class="row panel panel-flat">
            <div class="col-md-5 ml20">
                <?php $form = ActiveForm::begin(['id' => 'form-country']); ?>
                    <?= $form->field($model, 'name')->label("Nombre")->textInput(['autofocus' => true]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Crear Pa&iacute;s', ['class' => 'btn btn-primary', 'name' => 'form-country-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
