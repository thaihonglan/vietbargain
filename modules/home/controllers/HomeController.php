<?php

namespace app\modules\home\controllers;

use app\models\Post;
use yii\data\ActiveDataProvider;

class HomeController extends \app\modules\home\components\Controller
{
	public $defaultAction = 'index';

	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Post::find(),
			'pagination' => [
				'pageSize' => 10,
			],
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider
		]);
	}

}
