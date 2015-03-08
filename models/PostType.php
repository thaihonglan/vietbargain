<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_type".
 *
 * @property integer $id
 * @property string $name_vi
 * @property string $name_en
 * @property integer $is_parent
 * @property integer $parent_id
 */
class PostType extends \app\components\ActiveRecord
{
	private static $_data = null;

	private $_children = [];

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'post_type';
	}

	/**
	 * @inheritdoc
	 */
	public function attributes()
	{
		return [
			'id',
			'name_vi',
			'name_en',
			'is_parent',
			'parent_id',
		];
	}

	public function setChildren($values)
	{
		$this->_children = $values;
	}

	public function getChildren()
	{
		return $this->_children;
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name_vi', 'name_en'], 'required'],
			[['is_parent', 'parent_id'], 'integer'],
			[['name_vi', 'name_en'], 'string', 'max' => 64]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'name_vi' => Yii::t('admin', 'Vietnamese Name'),
			'name_en' => Yii::t('admin', 'English Name'),
			'is_parent' => Yii::t('admin', 'Is Parent'),
			'parent_id' => Yii::t('admin', 'Parent ID'),
		];
	}

	public function scenarios()
	{
		return [
			'create' => ['name_vi', 'name_en'],
			'update' => ['name_vi', 'name_en'],
		];
	}

	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		if ($this->parent_id != 0) {
			$parent = self::findOne(['id' => $this->parent_id]);

			if ($parent->is_parent == 0) {
				if ($insert || self::find()->where(['is_parent' => $parent->id])->exists()) {
					$connection = \Yii::$app->db;
					$connection->createCommand()->update(self::tableName(), ['is_parent' => 1], ['id' => $parent->id])->execute();
				}
			}
		}
	}

	public function afterDelete()
	{
		parent::afterDelete();

		if ($this->parent_id != 0) {
			if (!self::find()->where(['is_parent' => $this->parent_id])->exists()) {
				$connection = \Yii::$app->db;
				$connection->createCommand()->update(self::tableName(), ['is_parent' => 0], ['id' => $this->parent_id])->execute();
			}
		}
	}

	public function getName()
	{
		return $this->{'name_' . self::getLang()};
	}

	public static function findFull()
	{
		if (self::$_data === null) {
			self::$_data = self::find()->all();
		}

		$data = self::$_data;

		return $data;
	}

	public static function findAllAsFiliation($currentId = 0)
	{
		$items = self::findFull();

		if ($currentId == 0) {
			return self::_loopFiliation($items, $currentId);
		}

		foreach ($items as $item) {
			if ($item->id == $currentId) {
				if ($item->is_parent) {
					$item->children = self::_loopFiliation($items, $item->id);
				}

				return [$item];
			}
		}
	}

	/**
	 * Get PostType list as JsTree format
	 * @return array
	 */
	public static function findPostTypeJsTree()
	{
		$postTypeList = PostType::find()->all();
		list($lang) = explode('-', \Yii::$app->language);

		$data = [
			[
				'id' => '0',
				'parent' => '#',
				'text' => 'Root'
			]
		];

		foreach ($postTypeList as $type) {
			$data[] = [
				'id' => $type['id'],
				'parent' => $type['parent_id'],
				'text' => $type['name_' . $lang]
			];
		}

		return $data;
	}

	private static function _loopFiliation(&$items, $currentId)
	{
		$return = [];
		foreach ($items as $item) {
			if ($item->parent_id == $currentId) {
				if ($item->is_parent) {
					$item->children = self::_loopFiliation($items, $item->id);
				}
				$return[] = $item;
			}
		}
		return $return;
	}
}
