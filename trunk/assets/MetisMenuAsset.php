<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Metis Menu assets
 * @author KM
 */
class MetisMenuAsset extends AssetBundle
{
	public $basePath = '@webroot/plugins/metisMenu';
	public $baseUrl = '@web/plugins/metisMenu';

	public $css = [
		'css/metisMenu.min.css',
	];

	public $js = [
		'js/metisMenu.min.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];
}
