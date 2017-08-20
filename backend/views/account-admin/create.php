<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AccountAdmin */

$this->title = 'Create Account Admin';
$this->params['breadcrumbs'][] = ['label' => 'Account Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
