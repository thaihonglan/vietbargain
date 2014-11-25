<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Font Awesome assets
 * @author KM
 */
class FontAwesomeAsset extends AssetBundle
{
	public $basePath = '@webroot/plugins/font-awesome';
	public $baseUrl = '@web/plugins/font-awesome';

	public $css = [
		'css/font-awesome.min.css',
	];
}
