<?php
namespace app\modules\home\components;

use Yii;
use app\models\PostType;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends \yii\web\Controller
{
	public $params = [];

	public function afterAction($action, $result)
	{
		$this->params['postType'] = PostType::findAllAsfiliationArray();
		return parent::afterAction($action, $result);
	}
}