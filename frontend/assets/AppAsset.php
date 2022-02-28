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
        'css/bootstrap.css',
        'https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap',
        'css/font-awesome.min.css',
        'css/style.css',
        'css/responsive.css'
    ];
    public $js = [
        'js/jquery-3.4.1.min.js',
        'js/bootstrap.js',
        'js/custom.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
 