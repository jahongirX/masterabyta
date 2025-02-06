<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/admin/bootstrap-datepicker.css',
        'css/admin/wickedpicker.min.css?1',
        'css/admin/site.css',
        'css/admin/custom.css',
    ];
    public $js = [
        'js/admin/bootstrap-datepicker.js',
        'js/admin/bootstrap-datepicker.ru.min.js',
        'js/admin/wickedpicker.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
