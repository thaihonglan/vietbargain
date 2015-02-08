<?php

namespace app\modules\home\controllers;

use Yii;
use app\modules\home\models\ProfileForm;
use app\models\Post;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

class AccountController extends \app\modules\home\components\Controller
{
	protected $_params = [
		'postPageSize' => 2
	];

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

	public function actionShowPost()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Post::find()->where(['user_id' => Yii::$app->user->id]),
		]);

		return $this->render('show-post', [
			'dataProvider' => $dataProvider
		]);
	}

}
