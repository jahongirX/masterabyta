<?php

namespace app\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic",
        "libs/style7dd3.css",
        "libs/jquery.scrollbar.css",
        "libs/css/font-awesome.min.css",
        "libs/css/animate.css",
        "libs/css/fix23c9e0.css",
        "libs/adaptive68b3.css",
        "libs/slick/slick.css",
        "libs/slick/slick-theme.css" ,
        "libs/callback/styles/styleb6fc.css?v=1.1.9",
        "libs/fancybox/jquery.fancybox.min.css",
        "libs/css/style.min.css",
        "libs/newstyle68b3.css",
//        'css/admin/custom.css',
    ];
    public $js = [
        "libs/js/jquery-3.3.1.min.js",
        "libs/sender/inputmask/dist/inputmask.min.js",
        "libs/sender/script.js",
        "libs/slick/slick.min.js",
        "libs/fancybox/jquery.fancybox.min.js",
        "libs/jquery.scrollbar.min.js",
        "libs/js/hooks.min.js",
        "libs/js/i18n.min.js",
        "https://masterabyta.ru/wp-content/plugins/contact-form-7/includes/swv/js/index.js",
        "libs/js/index.js",
        "libs/js/vendor/wp-polyfill.min.js",
        "libs/callback/js/1000hz-bootstrap-validator-0.11.5.js",
        "libs/callback/js/scripts944c.js",
        "libs/mainsome.js",
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
    ];
}
