<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

//$this->title = 'Quienes Somos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<section id="about" class="color0">
    <div class="title">
        <h1><?= Html::encode("Quienes Somos") ?></h1>
<!--        <h2 class="subTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut massa ante.</h2>-->
    </div>
    <!-- section content -->
    <section class="pt30 pb30">
        <div class="container">
            <div class="row vertical-align">
                <div class="col-sm-4">
                    <?= Html::img(Yii::getAlias('@web') . '/images/logo.jpg', ['class' => 'img-responsive about-logo']) ?>
                </div>
                <div class="col-sm-8">
                    <h2 class="text-center"><b>REMESAS.CL | Chile.net.ve</b></h2>
                    <p><b class="text-uppercase">Somos</b> una familia de economistas que nos unimos para formar y legalizar un negocio de envío de remesas, ubicados actualmente en Chile.</p>

                    <p>Nuestros <b class="text-uppercase">valores</b> principales son el profesionalismo, la honestidad, la seguridad y la confianza.</p>

                    <p>Nuestro <b class="text-uppercase">objetivo</b> es ayudar a los Venezolanos que se encuentran en Chile para poder cambiar la moneda y enviar bolívares a sus familiares en Venezuela.</p>
                </div>
                <!--<div class="col-sm-4">
                    <h2>Mauris blandit, mauris ut luctus tempor.</h2>
                    <p>Suspendisse cursus malesuada tempus. Fusce tellus lorem, posuere ut sagittis hendrerit, pellentesque eu est. Fusce non aliquet enim, ac posuere lectus. Duis sit amet libero pellentesque massa viverra mattis vitae maximus mi. Etiam vitae sem nec dolor iaculis eleifend at eu diam.</p>
                    <h3>Vestibulum ante ipsum primis in faucibus orci.</h3>
                    <p>Nunc a massa sed risus rhoncus imperdiet eu sed odio. Curabitur lacinia magna vel arcu vestibulum, eu porta massa eleifend. Mauris condimentum fringilla nulla, nec placerat leo hendrerit a.</p>
                </div>-->
            </div>
        </div>
    </section>
</section>
