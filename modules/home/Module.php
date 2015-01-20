<?php

namespace app\modules\home;

use Yii;

class Module extends \app\components\Module
{
	public $controllerNamespace = 'app\modules\home\controllers';

	public $layout = 'main';

	public function init()
	{
		parent::init();

		// initialize the module with the configuration loaded from config.php
		self::configure(Yii::$app, require(__DIR__ . '/config.php'));

		// save link
		list($controller) = explode('/', Yii::$app->request->getPathInfo());
		if ($controller != 'auth') {
			$curLinkCookie = Yii::$app->request->cookies->getValue('home/curLink');
			if ($curLinkCookie != Yii::$app->request->url) {
				Yii::$app->response->cookies->add(new \yii\web\Cookie([
					'name' => 'home/preLink',
					'value' => $curLinkCookie,
				]));

				Yii::$app->response->cookies->add(new \yii\web\Cookie([
					'name' => 'home/curLink',
					'value' => Yii::$app->request->url,
				]));
			}
		}
	}
}
