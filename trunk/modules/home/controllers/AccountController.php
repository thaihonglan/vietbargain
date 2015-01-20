<?php

namespace app\modules\home\controllers;

use Yii;
use app\modules\home\models\ProfileForm;

class AccountController extends \app\modules\home\components\Controller
{
	public function actionEditProfile()
	{
		$model = new ProfileForm();

		$model->setAttributes(Yii::$app->request->post('ProfileForm'), false);
		if ($model->save()) {
			return $this->redirect(['account/edit-profile', 'success' => '1']);
		} else {
			return $this->render('edit-profile', [
				'model' => $model,
			]);
		}
	}

}
