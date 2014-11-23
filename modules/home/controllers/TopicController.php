<?php

namespace app\modules\home\controllers;

class TopicController extends \app\components\Controller
{
	public $defaultAction = 'show';

	public function actionNew()
	{
		return $this->render('new');
	}

	public function actionShow()
	{
		return $this->render('show');
	}

}
