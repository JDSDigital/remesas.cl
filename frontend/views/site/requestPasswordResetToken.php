<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\PasswordResetRequestForm;

$model = new PasswordResetRequestForm();

//$this->title = 'Resetear Contraseña';

?>

<div id="modal-reset-password" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h1><?= Html::encode("Resetear Contraseña") ?></h1>

                <p>Introduzca su correo y se le enviará un enlace para cambiar su contraseña.</p>

                <?php $form = ActiveForm::begin([
                    'id' => 'request-password-reset-form',
                    'action' => ['//site/index'],
                ]); ?>

                    <?= $form->field($model, 'email')->textInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>