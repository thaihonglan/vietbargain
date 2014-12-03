<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deal_type".
 *
 * @property string $id
 * @property string $name_vi
 * @property string $name_en
 */
class DealType extends \app\components\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'deal_type';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name_vi', 'name_en'], 'string', 'max' => 64]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('admin', 'ID'),
			'name_vi' => Yii::t('admin', 'Vietnames Name'),
			'name_en' => Yii::t('admin', 'English Name'),
		];
	}
}
