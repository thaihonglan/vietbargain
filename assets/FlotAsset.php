<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Flot Charts assets
 * @author KM
 */
class FlotAsset extends AssetBundle
{
	public $basePath = '@webroot/plugins/flot';
	public $baseUrl = '@web/plugins/flot';

	public $js = [
		'js/excanvas.min.js',
		'js/jquery.flot.js',
		'js/jquery.flot.pie.js',
		'js/jquery.flot.resize.js',
		'js/jquery.flot.tooltip.min.js',
		'js/flot-data.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];
}
