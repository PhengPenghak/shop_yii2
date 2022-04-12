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
        'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css',
        'css/styles.css',
        // 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',

    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',
        // 'https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js',
        // 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js',
        // 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js',
        'js/jquery-3.4.1.min.js',
        'js/bootstrap.js',
        'js/custom.js',
        'js/scripts.js',
        // 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}