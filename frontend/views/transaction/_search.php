<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'clientId') ?>

    <?= $form->field($model, 'accountClientId') ?>

    <?= $form->field($model, 'accountAdminId') ?>

    <?= $form->field($model, 'amountFrom') ?>

    <?php // echo $form->field($model, 'amountTo') ?>

    <?php // echo $form->field($model, 'exchangeId') ?>

    <?php // echo $form->field($model, 'userId') ?>

    <?php // echo $form->field($model, 'clientBankTransaction') ?>

    <?php // echo $form->field($model, 'adminBankTransaction') ?>

    <?php // echo $form->field($model, 'observation') ?>

    <?php // echo $form->field($model, 'exchangeValue') ?>

    <?php // echo $form->field($model, 'winnings') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'transactionDate') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
