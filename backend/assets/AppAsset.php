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
        "listrace/assets/css/font-awesome.min.css",
        "listrace/assets/css/linearicons.css",
        "listrace/assets/css/animate.css",
        "listrace/assets/css/flaticon.css",
        "listrace/assets/css/slick.css",
        "listrace/assets/css/slick-theme.css",
        "listrace/assets/css/bootstrap.min.css",
        "listrace/assets/css/bootsnav.css" , 
        "listrace/assets/css/style.css",
        "listrace/assets/css/responsive.css",
    ];
    public $js = [
        "listrace/assets/js/jquery.js",
        "listrace/https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js",
        "listrace/assets/js/bootstrap.min.js",
        "listrace/assets/js/bootsnav.js",
        "listrace/assets/js/feather.min.js",
        "listrace/assets/js/jquery.counterup.min.js",
        "listrace/assets/js/waypoints.min.js",
        "listrace/assets/js/slick.min.js",
        "listrace/https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js",
        "listrace/assets/js/custom.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
