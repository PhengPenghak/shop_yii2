<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SweetAlertAsset extends AssetBundle
{
    public $basePath = '@webroot/sweetalert/dist';
    public $baseUrl = '@web';
    public $css = [
        'sweetalert.css',
    ];
    public $js = [
         'sweetalert.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
       
    ];
}
 