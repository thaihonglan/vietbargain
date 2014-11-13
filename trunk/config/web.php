<?php

$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'vietbargin',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],

	'modules' => [
		'admin' => [
			'class' => 'app\modules\admin\Module',
		],
	// ...
	],
	'components' => [
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
		],
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'efaewfawegewg',
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
			'enableAutoLogin' => true,
			'loginUrl' => ['auth/login'],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db' => require(__DIR__ . '/db.php'),
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
		'generators' => [
			'crud' => [
				'class' => 'yii\gii\generators\crud\Generator', //class generator
				'templates' => [       //setting for out templates
					'admin' => '@app/components/giiTemplate/crud/admin', //name template => path to template
				],
			],
			'model' => [
				'class' => 'yii\gii\generators\model\Generator', //class generator
				'templates' => [       //setting for out templates
					'all' => '@app/components/giiTemplate/model/default', //name template => path to template
				],
			],
		],
	];
}

return $config;
