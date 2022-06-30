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
        // 'css/bootstrap.css',
        'https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap',
        'css/font-awesome.min.css',
        'css/style.css',
        'css/responsive.css',
        'css/styles.css',
        'css/navbtn.css',
        'css/page-cart.css',
        'css/profile.css',
        'css/darkmode.css',
        'css/leftnavbar.css',
        'https://polyfill.io/v3/polyfill.min.js?features=default',
        'css/message.css',
        'https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css',
        'css/gird.css'
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',

        'js/jquery-3.4.1.min.js',
        'js/bootstrap.js',
        'js/custom.js',
        'js/scripts.js',
        'js/googlemap.js',
        'js/darkmode.js',
        'js/chat.js',
        'https://maps.googleapis.com/maps/api/js?AIzaSyBZaSqieNhh6dQYA3Tc2rj3glct0EzU7-Y&callback=initMap&v=weekly'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
