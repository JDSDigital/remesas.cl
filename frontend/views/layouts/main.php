<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Transaction;
use frontend\models\ContactForm;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

$this->registerMetaTag(['name' => 'author', 'content' => 'geknology.com']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Envío seguro de remesas. Cuidamos tu dinero.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'remesas, pesos, bolivares, dinero, seguro, confianza.']);

$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => Yii::getAlias('@web') . '/images/favicons/apple-touch-icon.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => Yii::getAlias('@web') . '/images/favicons/favicon-32x32.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => Yii::getAlias('@web') . '/images/favicons/favicon-16x16.png']);

/*$contact = new ContactForm();
Yii::$app->view->params['contact'] = $contact;*/

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="xy82MCBzLNyMLDhUy2RonqBGuuvETRJCni5weaBaYK4" />
    <?= Html::csrfMetaTags() ?>

    <!-- web font  -->
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>

<!--<link rel="manifest" href="/manifest.json">-->
<!--<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">-->
<!--<meta name="theme-color" content="#ffffff">-->

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img(Yii::getAlias('@web') . '/images/logo2.png', ['class' => 'nav-logo img-responsive']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Inicio', 'url' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? '#index' : ['/site/index'], 'linkOptions' => ['id' => 'btn-index']],
        ['label' => 'Quienes Somos', 'url' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? '#about' : ['/site/index'], 'linkOptions' => ['id' => 'btn-about']],
        ['label' => 'Contacto', 'url' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? '#contact' : ['/site/index'], 'linkOptions' => ['id' => 'btn-contact']],
        ['label' => 'Preguntas Frecuentes', 'url' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? '#contact' : ['/site/index'], 'linkOptions' => ['id' => 'btn-faq']],

    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Enviar Dinero', 'linkOptions' => ['id' => 'send-money-button', 'data-toggle' => 'modal', 'data-target' => '#modal-login']];
        $menuItems[] = ['label' => 'Registro', 'linkOptions' => ['data-toggle' => 'modal', 'data-target' => '#modal-signup']];
        $menuItems[] = ['label' => 'Inicio de sesión', 'linkOptions' => ['data-toggle' => 'modal', 'data-target' => '#modal-login']];
    } else {

        if (Transaction::find()->where(['clientId' => Yii::$app->user->identity->id])->count() > 0)
            $menuItems[] = ['label' => 'Transacciones', 'url' => ['/transaction/check'], 'linkOptions' => ['data-method' => 'post']];

        $menuItems[] = ['label' => 'Enviar Dinero', 'url' => ['//site/calculator'], 'linkOptions' => ['id' => 'send-money-button']];
        $menuItems[] = ['label' => 'Salir (' . Yii::$app->user->identity->name . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right list-inline'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="mt50">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

    <!-- footer -->
    <footer>
        <section id="mainFooter">
            <div class="container" id="footer">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="footerWidget">
                            <?= Html::img(Yii::getAlias('@web') . '/images/logo-alt2.png', ['id' => 'footerLogo', 'class' => 'img-responsive', 'alt' => 'Remesas.cl']) ?>
                        </div>
                    </div>

                    <div class="col-sm-3 col-sm-offset-1 text-left">

                            <h3>Remesas.cl</h3>
                            <address>
                                <h4>
                                    Santiago de Chile<br>
                                    Chile <br><br>
                                    <a href="mailto:contacto@remesas.cl">contacto@remesas.cl</a>
                                </h4>
                            </address>
                    </div>
                    <div class="col-sm-4">
                        <div class="footerWidget" style="float:left">
                            <h3>¡Síguenos!</h3>
                            <ul class="socialNetwork">
                                <li><a href="https://www.instagram.com/remesas.cl/" class="tips" title="" data-original-title="follow me on Instagram" target="_blank"><i class="fa fa-lg fa-instagram iconRounded"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="footerRights">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Copyright © <?= date('Y') ?> <?= Html::a('Remesas.cl',['//site/index']) ?> / Diseño y desarrollo por <?= Html::a('Geknology', Url::to('http://www.geknology.com/')) ?></p>
                    </div>

                </div>
            </div>
        </section>
    </footer>
    <!-- End footer -->

<!-- ================================
          Modal1
    ==================================-->
<?= Yii::$app->controller->renderPartial('//site/login'); ?>
<!-- /. End Modal1 -->

<!-- ================================
          Modal2
    ==================================-->
<?= Yii::$app->controller->renderPartial('//site/requestPasswordResetToken'); ?>
<!-- /. End Modal2 -->

<!-- ================================
          Modal3
    ==================================-->
<?= Yii::$app->controller->renderPartial('//site/signup'); ?>
<!-- /. End Modal3 -->

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5a1eb322bb0c3f433d4cbf42/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

<?php
//$this->registerJsFile('@web/js-plugin/parallax/js/jquery.scrollTo-1.4.3.1-min.js',	['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@web/js-plugin/parallax/js/jquery.localscroll-1.2.7-min.js',	['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
