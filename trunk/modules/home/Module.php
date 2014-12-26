<?php

namespace app\modules\home;

use Yii;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\modules\home\controllers';

	public $layout = 'main';

	public function init()
	{
		parent::init();

		// setting authenticate
		\Yii::configure(Yii::$app->user, [
			'identityClass' => 'app\models\User',
			'returnUrl' => ['/'],
			'loginUrl' => ['auth/login'],
		]);

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
