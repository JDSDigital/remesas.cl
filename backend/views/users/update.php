<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Geknology';
?>
<div class="site-index">
    <div class="page-header no-border mb0">
        <div class="page-header-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-title">
                        <h3><?= Html::encode('Crear Usuario') ?></h3>
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
        <div class="row panel panel-flat">
            <div class="col-md-5 ml20">
                <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'role')->dropDownList([
                    'admin' => 'Administrador',
                    'user'  => 'Usuario',
                ], ['class' => 'form-control']) ?>
                <div class="form-group">
                    <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'name' => 'form-user-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
