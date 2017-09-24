<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $contact \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contáctanos';
?>
<section id="contact" class="container site-contact pb50">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Si tienes preguntas no dudes en escribirnos. Gracias.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($contact, 'name')->textInput() ?>

                <?= $form->field($contact, 'email') ?>

                <?= $form->field($contact, 'subject') ?>

                <?= $form->field($contact, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($contact, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</section>
