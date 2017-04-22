<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Sweet Alert files.
 */
class SweetAlertAsset extends AssetBundle
{
    public $sourcePath = '@bower/sweetalert/dist';
    public $css = [
        'sweetalert.css',
    ];
    public $js = [
        'sweetalert.min.js',
    ];
}
