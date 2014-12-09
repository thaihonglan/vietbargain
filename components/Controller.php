<?php
namespace app\components;

use Yii;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends \yii\web\Controller
{
	protected $_params = [];

	public function render($view, $params = [])
	{
		if (!empty($this->_params)) {
			$params = array_merge($this->_params, $params);
		}

		return parent::render($view, $params);
	}

	public function assign($key, $value)
	{
		$this->_params[$key] = $value;
	}

	public function saveBacklink($action) {
		$action = trim($action, '/');
		Yii::$app->response->cookies->add(new \yii\web\Cookie([
			'name' => $this->module->id . '/back/' . $action,
			'value' => Yii::$app->request->url,
		]));
	}

	public function getBacklink($action) {
		$action = trim($action, '/');
		return Yii::$app->request->cookies->getValue($this->module->id . '/back/' . $action, \yii\helpers\Url::to([$action]));
	}
}