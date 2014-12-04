<?php

$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'vietbargin',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],

//     'language' => 'en-US',
	'language' => 'vi-VN',

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
				'site/<action>' => 'site/<action>',
				'<controller>/<action>' => 'home/<controller>/<action>',
			],
		],

		'mailSender' => [
			'class' => 'app\components\MailSender',
		],

		'assetManager' => [
			'class' => 'yii\web\AssetManager',
			'bundles' => [
				'yii\web\JqueryAsset' => [
					'basePath' => '@webroot/plugins/jquery',
					'baseUrl' => '@web/plugins/jquery',
				],
				'bootstrap' => [
					'class' => 'yii\bootstrap\BootstrapAsset',
					'basePath' => '@webroot/plugins/bootstrap',
					'baseUrl' => '@web/plugins/bootstrap',
					'js' => [YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js'],
					'css' => [YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css'],
				],
				'metisMenu' => [ // Metis Menu Plugin
					'class' => 'app\assets\MetisMenuAsset',
				],
				'dataTables' => [ // DataTables
					'class' => 'app\assets\DataTablesAsset',
				],
				'morris' => [ // Morris Charts JavaScript
					'class' => 'app\assets\MorrisAsset',
				],
				'flot' => [ // Flot Charts JavaScript
					'class' => 'app\assets\FlotAsset',
				],
				'fontAwesome' => [ // Flot Charts JavaScript
					'class' => 'app\assets\FontAwesomeAsset',
				],
				'socialButtons' => [ // Flot Charts JavaScript
					'class' => 'app\assets\SocialButtonsAsset',
				],
				'sliderRevolution' => [ // Slider Revolution
					'class' => 'app\assets\SliderRevolutionAsset',
				],
			],
		],

		'i18n' => [
			'translations' => [
				'admin*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/modules/admin/messages',
					'sourceLanguage' => 'en-US',
					'fileMap' => [
						'admin' => 'main.php',
						'admin/error' => 'error.php',
					],
				],
				'home*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/modules/home/messages',
					'sourceLanguage' => 'en-US',
					'fileMap' => [
						'home' => 'main.php',
						'home/error' => 'error.php',
					],
				],
				'model' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/models/messages',
					'sourceLanguage' => 'en-US',
					'fileMap' => [
						'model' => 'main.php',
					],
				],
			],
		],

		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'thisisaproductofkm',
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
