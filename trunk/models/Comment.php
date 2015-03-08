<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $user_id
 * @property integer $post_id
 * @property integer $parent_id
 * @property string $create_datetime
 * @property integer $is_approved
 */
class Comment extends \app\components\ActiveRecord
{
	const STATUS_UNAPPROVED = 0;
	const STATUS_APPROVED = 1;
	const STATUS_BANNER = 2;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'comment';
	}

	/**
	 * @inheritdoc
	 */
	public function attributes()
	{
		$attributes = [
			'id',
			'content',
			'user_id',
			'post_id',
			'parent_id',
			'create_datetime',
			'is_approved',
		];

		$user = new User();
		foreach ($user->attributes() as $field) {
			$attributes[] = 'user_' . $field;
		}
		$attributes[] = 'user_full_name';
		return $attributes;
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content'], 'string'],
			[['user_id', 'post_id', 'parent_id', 'is_approved'], 'integer'],
			[['is_approved'], 'required'],
			[['create_datetime'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('admin', 'ID'),
			'content' => Yii::t('admin', 'Content'),
			'user_id' => Yii::t('admin', 'User ID'),
			'post_id' => Yii::t('admin', 'Post ID'),
			'parent_id' => Yii::t('admin', 'Parent ID'),
			'create_datetime' => Yii::t('admin', 'Create Datetime'),
			'is_approved' => Yii::t('admin', 'Is Approved'),
			'post.title' => Yii::t('admin', 'Is Approved'),
		];
	}

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function getPost()
	{
		return $this->hasOne(Post::className(), ['id' => 'post_id']);
	}

	/**
	 *
	 * @param string $key
	 * @return content list status or single type by $key
	 */
	public static function getStatusOptions($key = null)
	{
		$array = [
			self::STATUS_UNAPPROVED => Yii::t('model', 'Inactive'),
			self::STATUS_APPROVED   => Yii::t('model', 'Active'),
			self::STATUS_BANNER   => Yii::t('model', 'Banner'),
		];

		return $key !== null ? isset($array[$key]) ? $array[$key] : null : $array;
	}
}
