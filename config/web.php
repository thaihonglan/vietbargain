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
		'home' => [
			'class' => 'app\modules\home\Module',
		],
	// ...
	],
	'components' => [
		'urlManager' => [
			'class' => 'yii\web\UrlManager',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => true,
			'rules' => [
				'' => 'home/home/index',
				'admin/<controller>/<action>' => 'admin/<controller>/<action>',
				'<controller>/<action>' => 'home/<controller>/<action>',
			],
		],

		'mailSender' => [
			'class' => 'app\components\mailSender',
		],

// 		'assetManager' => [
// 			'class' => 'yii\web\AssetManager',
// 			'basePath' => '@webroot',
// 			'baseUrl' => '@web',
// 			'bundles' => [
// 				'class' => 'app\assets\AppAsset',
// 				'app\modules\admin\assets\AppAsset' => [ // Custom Theme JavaScript
// 					'js' => ['js/sb-admin-2.js'],
// 					'depends' => [
// 						'bootstrap',
// 						'metisMenu',
// 						'dataTables',
// 						'morris',
// 						'flot',
// 					]
// 				],
// 				'jquery' => [
// 					'js' => ['js/jquery.js'],
// 				],
// 				'bootstrap' => [
// 					'js' => ['js/bootstrap.min.js'],
// 					'depends' => ['jquery']
// 				],
// 				'metisMenu' => [ // Metis Menu Plugin JavaScript
// 					'js' => ['js/plugins/metisMenu/metisMenu.min.js'],
// 					'depends' => ['jquery']
// 				],
// 				'dataTables' => [ // DataTables JavaScript
// 					'js' => [
// 						'js/plugins/dataTables/jquery.dataTables.js',
// 						'js/plugins/dataTables/dataTables.bootstrap.js'
// 					],
// 					'depends' => ['jquery']
// 				],
// 				'morris' => [ // Morris Charts JavaScript
// 					'js' => ['js/bootstrap.min.js'],
// 					'depends' => ['jquery']
// 				],
// 				'flot' => [ // Flot Charts JavaScript
// 					'js' => ['js/bootstrap.min.js'],
// 					'depends' => ['jquery']
// 				],
// 			],
// 		],

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
			'htmlLayout' => 'layouts/html',
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
