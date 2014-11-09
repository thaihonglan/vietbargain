<?php

namespace app\modules\admin;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\modules\admin\controllers';

	public $layout = 'main';

	public function init()
	{
		parent::init();

		// initialize the module with the configuration loaded from config.php
		\Yii::configure($this, require(__DIR__ . '/config.php'));
	}
}
