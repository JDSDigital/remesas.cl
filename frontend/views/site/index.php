<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\web\JqueryAsset;

$this->title = 'Remesas.cl';
?>
<div id="index" class="site-index">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <?= Html::img(Yii::getAlias('@web') . '/images/step1.jpg'); ?>
          </div>

          <div class="item">
            <?= Html::img(Yii::getAlias('@web') . '/images/step2.jpg'); ?>
          </div>

          <div class="item">
            <?= Html::img(Yii::getAlias('@web') . '/images/step3.jpg'); ?>
          </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
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
<?php //$this->registerJsFile(Yii::getAlias('@web') . '/js-plugin/supersized/js/supersized.3.2.7.min.js', ['depends' => [JqueryAsset::className()]]); ?>