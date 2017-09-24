<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registrarse';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'name')->label("Nombre")->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'lastName')->label("Apellido") ?>
                <?= $form->field($model, 'rut')->label("Identificación Personal") ?>
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
