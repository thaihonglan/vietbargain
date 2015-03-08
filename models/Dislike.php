<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dislike".
 *
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $comment_id
 */
class Dislike extends \app\components\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'dislike';
	}

	/**
	 * @inheritdoc
	 */
	public function attributes()
	{
		return [
			'post_id',
			'user_id',
			'comment_id',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['post_id', 'user_id', 'comment_id'], 'required'],
			[['post_id', 'user_id', 'comment_id'], 'integer']
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
			'comment_id' => Yii::t('admin', 'Comment ID'),
		];
	}
}
