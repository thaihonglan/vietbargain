<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Slider Revolution assets
 *
 * @author KM
 * @link http://previous.themepunch.com/revolution4-jquery/liveguide/01.Sample-Boxed.html
 */
class SliderRevolutionAsset extends AssetBundle
{
	public $basePath = '@webroot/plugins/rs-plugin';
	public $baseUrl = '@web/plugins/rs-plugin';

	public $css = [
		'css/settings.css',
	];

	public $js = [
		'js/jquery.themepunch.plugins.min.js',
		'js/jquery.themepunch.revolution.min.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];
}
