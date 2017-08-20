<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AccountAdmin */

$this->title = 'Update Account Admin: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Account Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
