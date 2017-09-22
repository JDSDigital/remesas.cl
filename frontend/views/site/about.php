<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Quienes Somos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<section id="about" class="color0">
    <div class="title">
        <h1><?= Html::encode($this->title) ?></h1>
        <h2 class="subTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut massa ante.</h2>
    </div>
    <!-- section content -->
    <section class="pt30 pb30">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <?= Html::img(Yii::getAlias('@web') . '/images/logo.jpg', ['class' => 'img-responsive']) ?>
                </div>
                <div class="col-sm-4">
                    <h2>Lorem ipsum dolor sit amet.</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut massa ante. Mauris blandit, mauris ut luctus tempor, tellus sem semper purus, nec rhoncus sapien eros a dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed consequat aliquet augue non molestie. Praesent tempor lacus ut neque vehicula, ut dapibus massa congue. Duis posuere tellus eu risus pellentesque rutrum. Phasellus augue neque, finibus et mauris id, rutrum sollicitudin nisi.</p>

                    <p>Nulla facilisi. Aenean cursus ex nec metus dictum, sit amet rhoncus leo auctor. Curabitur quis turpis urna. Nullam non dictum nulla. Nullam mattis convallis massa non ullamcorper. Nam venenatis odio a sollicitudin maximus. Vestibulum ut purus at quam pulvinar commodo. Curabitur id maximus erat.</p>
                </div>
                <div class="col-sm-4">
                    <h2>Mauris blandit, mauris ut luctus tempor.</h2>
                    <p>Suspendisse cursus malesuada tempus. Fusce tellus lorem, posuere ut sagittis hendrerit, pellentesque eu est. Fusce non aliquet enim, ac posuere lectus. Duis sit amet libero pellentesque massa viverra mattis vitae maximus mi. Etiam vitae sem nec dolor iaculis eleifend at eu diam.</p>
                    <h3>Vestibulum ante ipsum primis in faucibus orci.</h3>
                    <p>Nunc a massa sed risus rhoncus imperdiet eu sed odio. Curabitur lacinia magna vel arcu vestibulum, eu porta massa eleifend. Mauris condimentum fringilla nulla, nec placerat leo hendrerit a.</p>
                </div>
            </div>
        </div>
    </section>
</section>
