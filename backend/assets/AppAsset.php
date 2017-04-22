<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/master.css',
        'css/site.css',
    ];
    public $js = [
        'js/yii_overrides.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\ThemeAsset',
        'app\assets\TetherAsset',
        'app\assets\BootstrapAsset',
        'app\assets\SweetAlertAsset',
        'app\assets\FontAwesomeAsset',
    ];
}
