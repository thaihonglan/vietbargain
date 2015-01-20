<?php

namespace app\modules\home\controllers;

use Yii;
use app\modules\home\models\LoginForm;
use app\modules\home\models\SignupForm;
use app\models\City;

class AuthController extends \app\modules\home\components\Controller
{
	public $layout = 'main';

	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->goBack();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->redirect(Yii::$app->request->cookies->getValue('home/preLink'));
		} else {
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goBack();
	}

	public function actionRegister()
	{
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post()) && $model->signup()) {
			return $this->redirect(['login']);
		} else {
			$cityList = City::find()->asArray()->all();

			return $this->render('register', [
				'model' => $model,
				'cityList' => $cityList,
			]);
		}
	}
}
