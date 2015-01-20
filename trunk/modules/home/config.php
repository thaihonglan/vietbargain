<?php

return [
// 	'homeUrl' => [''],

	// list of component configurations
	'components' => [
		'user' => [
			'class' => 'yii\web\User',
			'identityClass' => 'app\models\User',
			'enableAutoLogin' => true,
			'returnUrl' => ['/'],
			'loginUrl' => ['auth/login'],
		],

		'assetManager' => [
			'bundles' => [
				'recursive' => true,
			],
			'recursive' => true,
		],
	],
];
