<?php
namespace app\modules\home\components;

use Yii;
use app\models\PostType;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends \app\components\Controller
{
    public $params = [];

    public function beforeAction($action)
    {
        $this->params['postType'] = PostType::findAllAsFiliation();

        return parent::beforeAction($action);
    }
}