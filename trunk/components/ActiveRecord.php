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

	public function beforeSave($insert)
	{
		if ($insert) {
			if (in_array('create_datetime', $this->attributes())) {
				$this->create_datetime = date('Y-m-d H:i:s');
			}
			if (in_array('modify_datetime', $this->attributes())) {
				$this->modify_datetime = date('Y-m-d H:i:s');
			}
		} else {
			if (in_array('modify_datetime', $this->attributes())) {
				$this->modify_datetime = date('Y-m-d H:i:s');
			}
		}

		return parent::beforeSave($insert);
	}
}