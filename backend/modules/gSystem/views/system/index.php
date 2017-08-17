<?php

/* @var $this yii\web\View */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Geknology';
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Configuración') ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content panel-body">
        <?php $form = ActiveForm::begin(['id' => 'form-config', 'class' => 'form-horizontal']); ?>
            <fieldset class="content-group">

                <legend class="text-bold"><?= Html::encode('Información de la Empresa') ?></legend>
                <div class="form-group mb40">
                    <div class="row">
                        <div class="col-lg-5">
                            <?= $form->field($model, 'domain')->textInput() ?>
                        </div>
                        <div class="col-lg-5">
                            <?= $form->field($model, 'title')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <?= $form->field($model, 'company')->textInput() ?>
                        </div>
                        <div class="col-lg-5">
                            <?= $form->field($model, 'rut')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            <?= $form->field($model, 'address')->textarea() ?>
                        </div>
                    </div>
                </div>

                <legend class="text-bold"><?= Html::encode('Imágenes') ?></legend>
                <div class="form-group mb40">
                    <div class="row">
                        <div class="col-lg-5">
                            <?= $form->field($model, 'logo')->textInput() ?>
                        </div>
                        <div class="col-lg-5">
                            <?= $form->field($model, 'icon')->textInput() ?>
                        </div>
                    </div>
                </div>

                <legend class="text-bold"><?= Html::encode('Datos de contacto') ?></legend>
                <div class="form-group mb40">
                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'name')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'email')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phone')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phoneAlt')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'mobile')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'mobileAlt')->textInput() ?>
                        </div>
                    </div>
                </div>

                <legend class="text-bold"><?= Html::encode('Redes Sociales') ?></legend>
                <div class="form-group mb40">
                    <div class="row">
                        <div class="col-lg-4">
                            <?= $form->field($model, 'facebook')->textInput() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'twitter')->textInput() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'youtube')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <?= $form->field($model, 'skype')->textInput() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'linkedin')->textInput() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'pinterest')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <?= $form->field($model, 'googlePlus')->textInput() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'instagram')->textInput() ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'vimeo')->textInput() ?>
                        </div>
                    </div>

                </div>

                <legend class="text-bold"><?= Html::encode('Datos del correo') ?></legend>
                <div class="form-group mb40">
                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'smtpUser')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'smtpPass')->passwordInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'smtpHost')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'smtpPort')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'smtpEncryption')->textInput() ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary ml15', 'name' => 'form-config-button']) ?>
                </div>
            </fieldset>
        <?php ActiveForm::end(); ?>
    </div>
</div>
