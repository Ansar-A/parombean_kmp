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

       "Azia/lib/fontawesome-free/css/all.min.css",
       "Azia/lib/ionicons/css/ionicons.min.css",
       "Azia/lib/typicons.font/typicons.css",
       "Azia/lib/flag-icon-css/css/flag-icon.min.css",
       "Azia/css/azia.css",
      
    ];
    public $js = [
        "Azia/lib/jquery/jquery.min.js",
        "Azia/lib/bootstrap/js/bootstrap.bundle.min.js",
        "Azia/lib/ionicons/ionicons.js",
        "Azia/lib/jquery.flot/jquery.flot.js",
        "Azia/lib/jquery.flot/jquery.flot.resize.js",
        "Azia/lib/chart.js/Chart.bundle.min.js",
        "Azia/lib/peity/jquery.peity.min.js",
        "Azia/js/azia.js",
        "Azia/js/chart.flot.sampledata.js",
        "Azia/js/dashboard.sampledata.js",
        "Azia/js/cookie.js"
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
