<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\admin;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/admin';

    public $baseUrl = '@web/admin';

    public $css = [
        'css/site.css',
        'css/timeline.css',
        'css/sb-admin-2.css',
    ];

    public $js = [
        'js/sb-admin-2.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'metisMenu',// blank
        'fontAwesome',//blank
    ];
}
