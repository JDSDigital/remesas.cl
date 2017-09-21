<?php

/* @var $this yii\web\View */

$this->title = 'Remesas.cl';
?>
<div class="site-index">

    <?= Yii::$app->controller->renderPartial('//site/contact', [
        'contact' => $contact,
    ]); ?>

</div>
