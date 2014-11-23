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
	}
}
