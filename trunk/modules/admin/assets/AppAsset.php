<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';

	public $baseUrl = '@web';

	public $css = [
		'css/site.css',
// 		'css/bootstrap.min.css',
		'css/bootstrap.css',
		'css/plugins/metisMenu/metisMenu.min.css',
		'css/plugins/social-buttons.css',
		'css/plugins/timeline.css',
		'css/plugins/dataTables.bootstrap.css',
		'css/sb-admin-2.css',
		'css/plugins/morris.css',
		'font-awesome-4.1.0/css/font-awesome.min.css'
	];

	public $js = [
		'js/jquery.js',
		'js/bootstrap.min.js',
		// Metis Menu Plugin JavaScript
		'js/plugins/metisMenu/metisMenu.min.js',
		// DataTables JavaScript
		'js/plugins/dataTables/jquery.dataTables.js',
		'js/plugins/dataTables/dataTables.bootstrap.js',
		// Morris Charts JavaScript
		'js/plugins/morris/raphael.min.js',
		'js/plugins/morris/morris.min.js',
		'js/plugins/morris/morris-data.js',
		// Flot Charts JavaScript
		'js/plugins/flot/excanvas.min.js',
		'js/plugins/flot/jquery.flot.js',
		'js/plugins/flot/jquery.flot.pie.js',
		'js/plugins/flot/jquery.flot.resize.js',
		'js/plugins/flot/jquery.flot.tooltip.min.js',
		'js/plugins/flot/flot-data.js',
		// Custom Theme JavaScript
		'js/sb-admin-2.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
