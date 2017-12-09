<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $contact \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

//$this->title = 'Contáctanos';
?>

<section id="contact" class="color0">
            <div class="title">
                <h1><?= Html::encode("Contáctanos") ?></h1>
            </div>
            <section class="pt30 pb30">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 pl30 pr30">
                            <h3><b>Direccion:</b></h3>
                            <address>
                                Santiago de Chile<br/>
                                Chile<br/>
                            </address>
                            <h3><b>Contacto:</b></h3>
                            <address>
                                contacto@remesas.cl<br/>
                            </address>
                        </div>
                        <div class="col-sm-8">
                            <?php $form = ActiveForm::begin([
                                'id' => 'contact-form',
                                'action' => ['//site/contact']
                            ]); ?>
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <?= $form->field($contact, 'name') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($contact, 'email') ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($contact, 'subject') ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?= $form->field($contact, 'body')->textarea(['rows' => 3]) ?>
                                    </div>
                                    <fieldset class="clearfix securityCheck">
                                        <legend>Security</legend>
                                        <div class="form-group">
                                            <?= $form->field($contact, 'verifyCode')->widget(Captcha::className(), [
                                                'template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>',
                                            ])->label(false) ?>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <div class="result"></div>
                                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-lg', 'name' => 'contact-button']) ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </section>
        </section>
