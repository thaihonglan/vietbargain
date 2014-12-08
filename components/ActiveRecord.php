<?php
namespace app\components;

use Yii;

/**
 * ActiveRecord is the customized base ActiveRecord class.
 * All model classes for this application should extend from this base class.
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
	public static function getLang()
	{
		static $lang = null;

		if (!$lang) {
			list($lang) = explode('-', \Yii::$app->language);
		}

		return $lang;
	}

}