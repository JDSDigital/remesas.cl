<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
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
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\TetherAsset',
        'app\assets\BootstrapAsset',
        'app\assets\FontAwesomeAsset',
        'app\assets\ThemeAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
