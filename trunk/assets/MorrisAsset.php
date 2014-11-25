<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Morris Charts assets
 * @author KM
 */
class MorrisAsset extends AssetBundle
{
	public $basePath = '@webroot/plugins/morris';
	public $baseUrl = '@web/plugins/morris';

	public $css = [
		'css/morris.css',
	];

	public $js = [
		'js/raphael.min.js',
		'js/morris.min.js',
		'js/morris-data.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];
}
