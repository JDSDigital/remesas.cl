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
            'brandLabel'   => Html::img(Yii::getAlias('@web') . '/images/GeknologyBorde.png', ['class' => 'img-fluid']),
            'brandOptions' => ['class' => 'p0'],
            'brandUrl'     => Yii::$app->homeUrl,
            'options'      => [
                'class' => 'navbar bg-slate-800 navbar-fixed-top',
            ],
			'innerContainerOptions' => [
				'class' => 'ml20 mr10',
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
			<div class="sidebar sidebar-main" style="position: fixed; width: 220px">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="row">
								<div class="col-xs-3">
									<?= Html::img(Yii::getAlias('@web') . '/images/user.png', ['class' => 'img-fluid']) ?>
								</div>
								<div class="col-xs-8 my-auto">
									<div class="media-body">
										<span class="media-heading text-semibold m0">
											<?= Yii::$app->user->identity->username ?>
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
                            
                                if (Yii::$app->user->identity->role == 'admin' || Yii::$app->user->identity->role == 'root'){
                                    $items = [
    									['label' => '<i class="icon-home4"></i>Inicio', 'url' => ['//site/index']],
//    									['label' => '<i class="icon-wrench"></i>Sistema', 'url' => ['//gSystem/system/index']],
    									['label' => '<i class="icon-user"></i>Usuarios', 'url' => ['//gUsers/users/index']],
                                        ['label' => '<i class="fa fa-users"></i>Clientes', 'url' => ['//client/index']],
                                        ['label' => '<i class="fa fa-exchange"></i>Transacciones', 'url' => ['//transaction/index']],
                                        ['label' => '<i class="fa fa-bar-chart"></i>Reporte de ganancias', 'url' => ['//transaction/winnings']],
                                        ['label' => '<i class="icon-coin-dollar"></i>Tasas de cambio', 'url' => ['//exchange-rate/index']],
                                        ['label' => '<i class="fa fa-address-card"></i>Cuentas bancarias', 'url' => ['//account-admin/index']],
                                        //['label' => '<i class="icon-user"></i>Países', 'url' => ['//country/index']],
                                        ['label' => '<i class="fa fa-bank"></i>Bancos', 'url' => ['//bank/index']],
                                        //['label' => '<i class="icon-user"></i>Monedas', 'url' => ['//currency/index']],
    								];
                                    
                                    if (Yii::$app->user->identity->role == 'root'){
                                        array_push($items, ['label' => '<i class="icon-user"></i>Países', 'url' => ['//country/index']], 
                                                             ['label' => '<i class="icon-user"></i>Monedas', 'url' => ['//currency/index']]);
                                    }  
                                }
                                else if (Yii::$app->user->identity->role == 'user'){
                                    $items = [
    									['label' => '<i class="icon-home4"></i>Inicio', 'url' => ['site/index']],
                                        ['label' => '<i class="icon-user"></i>Tasas de cambio', 'url' => ['//exchange-rate/index']],
    								];
                                }
                                else {
                                    $items = [
    									['label' => '<i class="icon-home4"></i>Inicio', 'url' => ['site/index']],
                                        ['label' => '<i class="fa fa-exchange"></i>Transacciones', 'url' => ['//transaction/index']],
    								];
                                }
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
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
