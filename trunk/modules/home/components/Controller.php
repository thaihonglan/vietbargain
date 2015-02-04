<?php
namespace app\modules\home\components;

use Yii;
use app\models\PostType;
use app\models\DealType;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends \app\components\Controller
{
	public $data = [];

	public function beforeAction($action)
	{
		$this->data['postType'] = PostType::findAllAsFiliation();

		$this->data['dealType'] = DealType::find()->all();

		return parent::beforeAction($action);
	}
}