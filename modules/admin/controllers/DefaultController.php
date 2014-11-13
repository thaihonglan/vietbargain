<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
	public function actionIndex()
	{
		print_r($this->module->params->dashboardUrl);
		return $this->render('index');
	}
}
