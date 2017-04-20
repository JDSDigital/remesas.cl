<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\assets\AppAsset;
use yii\widgets\Menu;

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Yii::getAlias('@web') . '/images/logo.png']);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
	<div class="row">
		<?php
        NavBar::begin([
            'brandLabel'   => Html::img(Yii::getAlias('@web') . '/images/logo-text.png', ['class' => 'img-fluid']),
            'brandOptions' => ['class' => 'p5'],
            'brandUrl'     => Yii::$app->homeUrl,
            'options'      => [
                'class' => 'navbar bg-slate-800 navbar-fixed-top',
            ],
        ]);
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
				. Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton('Cerrar Sesión (' . Yii::$app->user->identity->username . ')',
					['class' => 'btn btn-link logout'])
				. Html::endForm()
				. '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right list-inline'],
            'items'   => $menuItems,
        ]);
        NavBar::end();
        ?>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
	</div>
	<div class="row m0">
		<!-- Main sidebar -->
		<div class="col-md-2 p0">
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="row">
								<div class="col-xs-3">
									<?= Html::a(Html::img(Yii::getAlias('@web') . '/images/user.png', ['class' => 'img-fluid']), ['users/profile']) ?>
								</div>
								<div class="col-xs-8 my-auto">
									<div class="media-body">
										<span class="media-heading text-semibold m0">
											<?= Html::a(Yii::$app->user->identity->username, ['users/profile'], ['class' => 'navigation p0']) ?>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <!-- /user menu -->
                    <!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content p0">
							<?php
							(Yii::$app->user->identity->role == 'admin')
								? $items = [
									['label' => '<i class="icon-home4"></i>Inicio', 'url' => ['site/index']],
									['label' => '<i class="icon-wrench"></i>Sistema', 'url' => ['system/index']],
									['label' => '<i class="icon-user"></i>Usuarios', 'url' => ['users/index']],
								]
								: $items = [
									['label' => '<i class="icon-home4"></i>Inicio', 'url' => ['site/index']],
								];
                            echo Menu::widget([
                                'items'        => $items,
                                'options'      => ['class' => 'navigation navigation-main navigation-accordion'],
                                'encodeLabels' => false,
                            ]);
                            ?>
						</div>
					</div>
                    <!-- /main navigation -->

				</div>
			</div>
		</div>
        <!-- /main sidebar -->
		<div class="col-md-10 p0 mt20">
			<?= $content ?>
		</div>
	</div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode('Geknology') . ' ' . date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
