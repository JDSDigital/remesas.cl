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
        'css/icons.css',
        'css/site.css',
    ];
    public $js = [
        'js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\TetherAsset',
        'app\assets\BootstrapAsset',
        'app\assets\FontAwesomeAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
