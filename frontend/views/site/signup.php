<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

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

                <?= $form->field($model, 'name')->label("Nombre")->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'lastName')->label("Apellido") ?>
                <?= $form->field($model, 'rut')->label("Rut/Cédula") ?>
                <?= $form->field($model, 'phone')->label("Teléfono") ?>
                <?= $form->field($model, 'mobile')->label("Teléfono Móvil") ?>
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
