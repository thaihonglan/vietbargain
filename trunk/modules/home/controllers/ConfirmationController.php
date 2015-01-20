<?php

namespace app\modules\home\controllers;

use Yii;
use app\models\Request;
use app\models\User;
use app\modules\home\models\PasswordResetForm;

class ConfirmationController extends \app\modules\home\components\Controller
{
	public function actionRegister($k = null)
	{
		if ($k) {
			$confirmRequest = Request::find()->where(['request_key' => $k, 'request_type' => Request::TYPE_REGISTER_CONFIRM])
											->one();

			if ($confirmRequest && ($confirmRequest->status == Request::STATUS_UNUSED)) {
				$user = User::find()->where(['id' => $confirmRequest->user_id])->one();

				$user->status = User::STATUS_ACTIVE;
				if ($user->save(false, ['status'])) {
					$confirmRequest->status = Request::STATUS_USED;
					$confirmRequest->save();

					$message = Yii::t('admin', 'You have completed the registration.');
				} else {
					$message = Yii::t('admin', 'Something go wrong. Please try again a few minutes later.');
				}
			} else {
				$message = Yii::t('admin', 'This confirm key is invalid!');
			}
		} else {
			$message = Yii::t('admin', 'This confirm key is invalid!');
		}

		return $this->render('register', [
			'message' => $message,
		]);
	}

	public function actionRecoverPassword($k = null)
	{
		$model = new PasswordResetForm(['scenario' => 'confirm']);

		if ($model->loadConfirmKey($k) && $model->load(Yii::$app->request->post())) {
			$model->confirm();
		}

		return $this->render('recover-password', [
			'model' => $model,
		]);
	}

	public function actionUpdateEmail($k = null)
	{
		if ($k) {
			$confirmRequest = Request::find()->where(['request_key' => $k, 'request_type' => Request::TYPE_UPDATE_PASSWORD])
											->one();

			if ($confirmRequest && ($confirmRequest->status == Request::STATUS_UNUSED)) {
				$user = User::find()->where(['id' => $confirmRequest->user_id])->one();

				$data = json_decode($confirmRequest->data);

				$user->email = $data->email;
				if ($user->save(false, ['email'])) {
					$confirmRequest->status = Request::STATUS_USED;
					$confirmRequest->save();

					$message = Yii::t('admin', 'You have updated email successfully.');
				} else {
					$message = Yii::t('admin', 'Something go wrong. Please try again a few minutes later.');
				}
			} else {
				$message = Yii::t('admin', 'This confirm key is invalid!');
			}
		} else {
			$message = Yii::t('admin', 'This confirm key is invalid!');
		}

		return $this->render('update-email', [
			'message' => $message,
		]);
	}

}
