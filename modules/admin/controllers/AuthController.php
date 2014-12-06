<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\LoginForm;
use app\models\Admin;

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

	public function actionInitAdmin()
	{
		if (!Admin::find()->exists()) {
			$admin = new Admin();

			$admin->first_name = 'Admin';
			$admin->last_name = 'Admin';
			$admin->username = 'admin';
			$admin->password = 'patekimi';
			$admin->has_admin_authority = true;
			$admin->has_user_authority = true;
			$admin->has_deal_authority = true;
			$admin->has_dashboard_authority = true;

			$admin->save(false);
		}

		return Yii::$app->user->loginRequired();
	}
}
