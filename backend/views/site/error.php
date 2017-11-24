<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error mt50">
    <!-- Error wrapper -->
    <div class="container-fluid text-center">
        <h1 class="error-title">¡Ops!</h1>
        <h4 class="text-semibold content-group mt50"><?= nl2br(Html::encode($message)) ?></h4>
    </div>
    <!-- /error wrapper -->
</div>
