<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\LoginForm;

class AuthController extends Controller
{
	public $layout = false;

	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->goBack();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();

		return Yii::$app->user->loginRequired();
	}
}
