<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the wAdmin files.
 */
class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js-plugin/animation-framework/animate.css',
        'js-plugin/magnific-popup/magnific-popup.css',
        'js-plugin/isotope/css/style.css',

        'js-plugin/supersized/css/supersized.css',
	    'js-plugin/supersized/theme/supersized.shutter.css',

        'font-icons/custom-icons/css/custom-icons.css',
        'font-icons/custom-icons/css/custom-icons-ie7.css',

        'css/layout.css',
        'css/yellow.css',
        'css/custom.css',
    ];
    public $js = [
        'js/modernizr-2.6.1.min.js',
//        'js-plugin/supersized/js/supersized.3.2.7.min.js',
//        'js-plugin/supersized/theme/supersized.shutter.min.js',

//        'js-plugin/isotope/jquery.isotope.min.js',
//	    'js-plugin/isotope/jquery.isotope.sloppy-masonry.min.js',

//        'js-plugin/parallax/js/jquery.scrollTo-1.4.3.1-min.js',
//	    'js-plugin/parallax/js/jquery.localscroll-1.2.7-min.js',

//        'js-plugin/jquery-cookie/jquery.cookie.js',
//        'js/custom.js',
    ];
}
