<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\modules\admin\controllers';

	public $layout = 'main';

	public function init()
	{
		parent::init();

		// initialize the module with the configuration loaded from config.php
		\Yii::configure($this, require(__DIR__ . '/config.php'));

		// setting authenticate
		\Yii::configure(Yii::$app->user, [
			'identityClass' => 'app\models\Admin',
			'returnUrl' => ['admin/admin-manager/index'],
			'loginUrl' => ['admin/auth/login'],
		]);
	}

	public function behaviors()
	{

		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'controllers' => ['admin/auth'],
						'allow' => true,
					],
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}
}
