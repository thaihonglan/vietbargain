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
class DataTablesAsset extends AssetBundle
{
	public $basePath = '@webroot/plugins/dataTables';
	public $baseUrl = '@web/plugins/dataTables';

	public $css = [
		'css/dataTables.bootstrap.css',
	];

	public $js = [
		'js/jquery.dataTables.js',
		'js/dataTables.bootstrap.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];
}
