<?php
namespace app\components;

use Yii;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends \yii\web\Controller
{
	public function saveBacklink($action) {
		$action = trim($action, '/');
		Yii::$app->response->cookies->add(new \yii\web\Cookie([
			'name' => 'back/admin/' . $action,
			'value' => Yii::$app->request->url,
		]));
	}

	public function getBacklink($action) {
		$action = trim($action, '/');
		return Yii::$app->request->cookies->getValue('back/admin/' . $action, \yii\helpers\Url::to([$action]));
	}
}