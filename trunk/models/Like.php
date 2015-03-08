<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "like".
 *
 * @property integer $post_id
 * @property integer $user_id
 */
class Like extends \app\components\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'like';
	}

	/**
	 * @inheritdoc
	 */
	public function attributes()
	{
		return [
			'post_id',
			'user_id',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['post_id', 'user_id'], 'required'],
			[['post_id', 'user_id'], 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'post_id' => Yii::t('admin', 'Post ID'),
			'user_id' => Yii::t('admin', 'User ID'),
		];
	}
}
