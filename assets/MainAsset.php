<?php

namespace app\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
    ];
    public $js = [
        '/js/1000hz-bootstrap-validator-0.11.5.js',
        '/js/bxslider.min.js?ver=4.1.2',
        '/js/jquery.fancybox.js?ver=9.9.9',
        '/js/script.js?ver=2.0.9'
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
    ];
}
