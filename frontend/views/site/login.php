<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use common\models\ClientLoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$model = new ClientLoginForm();

//$this->title = 'Inicio de sesión';
?>

<div id="modal-login" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h1>Iniciar Sesión</h1>
                <?php $form = ActiveForm::begin([
                    'id'     => 'login-form',
                    'action' => ['//site/login'],
                ]); ?>

                <?= $form->field($model, 'email')->textInput() ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    Si olvidó su contraseña, puede resetearla <?= Html::a('aquí', ['#'], ['data-toggle' => 'modal', 'data-target' => '#modal-reset-password']) ?>.
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group text-left">
                            <?= Html::submitButton('Iniciar Sesión', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                    <div class="col-xs-6 text-right">
                        <?= Html::a('Registrarse', ['#'], ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal-signup']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>