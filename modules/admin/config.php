<?php

return [
	// list of component configurations
	'components' => [
		'view' => [
			'class' => '\yii\web\View',
			'theme' => [
				'pathMap' => ['@app/views' => '@app/modules/admin/views'],
				'baseUrl' => '@web/themes/basic',
			],
		],

// 		'assetManager' => [
// 			'class' => '\yii\web\AssetManager',
// 			'bundles' => [
// 				'class' => 'yii\web\AssetBundle',
// 				'AppAsset' => [
// 					'css' => ['all-xyz.css'],
// 					'js' => ['all-xyz.js'],
// 				],
// 			],
// 		],
	],

	// list of parameters
	'params' => [

	],
];
