<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;

$this->title = 'Remesas.cl';
?>
<div id="index" class="site-index">

    <div class="row">
        <div class="col-md-12">
            <?= Html::img(Yii::getAlias('@web') . '/images/steps.jpg', ['class' => 'img-responsive']) ?>
        </div>
    </div>

    <?= Yii::$app->controller->renderPartial('//site/about'); ?>

    <section id="paralaxSlice3" data-stellar-background-ratio="0.5" style="background-position: 50% 123px;">
        <div class="maskParent">
            <div class="paralaxMask"></div>
            <div class="paralaxText">
                <i class="icon-star iconMedium"></i>
                <blockquote class="mt15">
                    Write drunk; edit sober.<br><small>ERNEST HEMINGWAY </small>
                </blockquote>
            </div>
        </div>
    </section>

    <?= Yii::$app->controller->renderPartial('//site/contact', [
        'contact' => $contact,
    ]); ?>

</div>
