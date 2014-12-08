<?php

namespace app\modules\home\controllers;

class HomeController extends \app\modules\home\components\Controller
{
	public $defaultAction = 'index';

	public function actionIndex()
	{
		return $this->render('index');
	}

}
