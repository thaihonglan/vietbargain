<?php

namespace app\modules\home\controllers;

use Yii;
use app\modules\home\models\TopicForm;

class TopicController extends \app\modules\home\components\Controller
{
	public $defaultAction = 'show';

	public function actionNew()
	{
		if (\Yii::$app->user->isGuest) {
			return \Yii::$app->user->loginRequired();
		}

		$model = new TopicForm();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(Yii::$app->request->cookies->getValue('home/preLink'));
		} else {
			return $this->render('new', [
				'model' => $model,
			]);
		}
	}

	public function actionShow()
	{
		return $this->render('show');
	}

}
