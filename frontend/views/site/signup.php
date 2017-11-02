<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use borales\extensions\phoneInput\PhoneInput;
use frontend\models\SignupForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$model = new SignupForm();

$this->title = 'Registrarse';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div id="modal-signup" class="modal fade" role="dialog" style="top: -300px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h1><?= Html::encode($this->title) ?></h1>
                <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
                    'action' => ['//site/signup'],
                ]); ?>

                <?= $form->field($model, 'name')->label("Nombre")->textInput() ?>
                <?= $form->field($model, 'lastName')->label("Apellido") ?>
                <?= $form->field($model, 'rut')->label("Rut/Cédula") ?>
                <label class="control-label" for="signupform-phone">Teléfono</label>
                <?= $form->field($model, 'phone')->widget(PhoneInput::className(), [
                    'jsOptions' => [
                        'nationalMode'       => false,
                        'preferredCountries' => ['cl', 've'],
                    ],
                ])->label(false) ?>
                <label class="control-label" for="signupform-mobile">Teléfono Móvil</label>
                <?= $form->field($model, 'mobile')->widget(PhoneInput::className(), [
                    'jsOptions' => [
                        'autoHideDialCode'   => true,
                        'nationalMode'       => false,
                        'preferredCountries' => ['cl', 've'],
                    ],
                ])->label(false) ?>
                <?= $form->field($model, 'email')->label("Correo electrónico") ?>
                <?= $form->field($model, 'password')->label("Clave")->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Registrarse', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
