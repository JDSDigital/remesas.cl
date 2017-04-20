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
        'css/core.min.css',
        'css/components.min.css',
        'css/colors.min.css',
        'css/icons.css',
        'css/site.css',
    ];
    public $js = [
//        'js/uniform.min.js',
        'js/switchery.min.js',
        'js/switch.min.js',
        'js/app.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\TetherAsset',
        'app\assets\BootstrapAsset',
        'app\assets\FontAwesomeAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
