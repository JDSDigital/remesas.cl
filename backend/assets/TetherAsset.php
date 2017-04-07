<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap files.
 */
class TetherAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bordercloud/tether';
    public $css = [
        'dist/css/tether.min.css',
//        'dist/css/tether-theme-arrows.min.css',
//        'dist/css/tether-theme-arrows-dark.min.css',
//        'dist/css/tether-theme-basic.min.css',
    ];
    public $js = [
        'dist/js/tether.min.js'
    ];
}
