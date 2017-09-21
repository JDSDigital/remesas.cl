<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => Yii::getAlias('@web') . '/images/favicons/apple-touch-icon.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => Yii::getAlias('@web') . '/images/favicons/favicon-32x32.png']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => Yii::getAlias('@web') . '/images/favicons/favicon-16x16.png']);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        'brandLabel' => Html::img(Yii::getAlias('@web') . '/images/logo.png', ['class' => 'nav-logo img-responsive']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
        
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Cuentas disponibles', 'url' => ['/site/accounts']];
        $menuItems[] = ['label' => 'Mis Cuentas', 'url' => ['/account-client/index']];
        $menuItems[] = ['label' => 'Calculadora', 'url' => ['/site/calculator']];
        $menuItems[] = ['label' => 'Mis Transacciones', 'url' => ['/transaction/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right list-inline'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
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
                            <img src="images/neko-logo.png" alt="latest Little Neko news" id="footerLogo">
                            <p><a href="http://www.little-neko.com/" title="Little Neko, website template creation">Little Neko</a> is a web design and development studio. We build responsive HTML5 and CSS3 templates, integrating best web design practises and up-to-date web technologies to create great user experiences. We love what we do and we hope you too ! </p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="footerWidget">

                            <h3>Little NEKO</h3>
                            <address>
                                <p>
                                    <i class="icon-location"></i>&nbsp;77 Mass. Ave., E14/E15<br>
                                    Cambridge, MA 02139-4307 USA <br>
                                    <i class="icon-phone"></i>&nbsp;615.987.1234 <br>
                                    <i class="icon-mail-alt"></i>&nbsp;<a href="mailto:little@little-neko.com">little@little-neko.com</a>
                                </p>
                            </address>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="footerWidget">
                            <h3>Follow us, we are social</h3>
                            <ul class="socialNetwork">
                                <li><a href="#" class="tips" title="" data-original-title="follow me on Facebook"><i class="icon-facebook-1 iconRounded"></i></a></li>
                                <li><a href="#" class="tips" title="" data-original-title="follow me on Twitter"><i class="icon-twitter-bird iconRounded"></i></a></li>
                                <li><a href="#" class="tips" title="" data-original-title="follow me on Google+"><i class="icon-gplus-1 iconRounded"></i></a></li>
                                <li><a href="#" class="tips" title="" data-original-title="follow me on Linkedin"><i class="icon-linkedin-1 iconRounded"></i></a></li>
                                <li><a href="#" class="tips" title="" data-original-title="follow me on Dribble"><i class="icon-dribbble iconRounded"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section  id="footerRights">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Copyright © <?= date('Y') ?> <a href="http://www.little-neko.com/" target="blank">Little NEKO</a> / All rights reserved.</p>
                    </div>

                </div>
            </div>
        </section>
    </footer>
    <!-- End footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
