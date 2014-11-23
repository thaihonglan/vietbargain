<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\home\assets;

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
// 		'css/bootstrap.min.css',
		'css/bootstrap.css',
		'home/css/custom.css',
		'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800',
		'font-awesome-4.1.0/css/font-awesome.min.css',
		'home/css/style.css',
		'home/rs-plugin/css/settings.css',
	];

	public $js = [
		'js/jquery.js',
		// Slider Revolution 4.x JavaScript
		'home/rs-plugin/js/jquery.themepunch.plugins.min.js',
		'home/rs-plugin/js/jquery.themepunch.revolution.min.js',
		// Bootstrap JavaScript
		'js/bootstrap.min.js',
		'js/plugins/ckeditor/ckeditor.js',
	];

	public $depends = [
	];
}
