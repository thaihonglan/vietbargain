<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $short_content
 * @property integer $user_id
 * @property string $contact_number
 * @property string $store_address
 * @property string $link
 * @property string $discount_code
 * @property integer $is_owner
 * @property string $image
 * @property integer $deal_type
 * @property integer $like_number
 * @property integer $dislike_number
 * @property integer $comment_number
 * @property integer $view_number
 * @property string $deal_begin_date
 * @property string $deal_end_date
 * @property string $create_datetime
 * @property string $modify_datetime
 * @property integer $status
 */
class Post extends \app\components\ActiveRecord
{
	const STATUS_UNAPPROVED = 0;
	const STATUS_APPROVED = 1;
	const STATUS_BANNED = -1;
	const STATUS_UNLIKED = -2;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'post';
	}

	/**
	 * @inheritdoc
	 */
	public function attributes()
	{
		return [
			'id',
			'title',
			'content',
			'short_content',
			'user_id',
			'contact_number',
			'store_address',
			'link',
			'discount_code',
			'is_owner',
			'image',
			'deal_type_id',
			'like_number',
			'dislike_number',
			'comment_number',
			'view_number',
			'deal_begin_date',
			'deal_end_date',
			'create_datetime',
			'modify_datetime',
			'status',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content'], 'string'],
			[['user_id', 'is_owner', 'deal_type_id', 'like_number', 'dislike_number', 'comment_number', 'view_number', 'status'], 'integer'],
			[['deal_begin_date', 'deal_end_date', 'create_datetime', 'modify_datetime'], 'safe'],
			[['title', 'contact_number', 'discount_code'], 'string', 'max' => 32],
			[['short_content'], 'string', 'max' => 512],
			[['store_address'], 'string', 'max' => 128],
			[['link', 'image'], 'string', 'max' => 64]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'content' => Yii::t('app', 'Content'),
			'short_content' => Yii::t('app', 'Short Content'),
			'user_id' => Yii::t('app', 'User ID'),
			'user_fullName' => Yii::t('app', 'User ID'),
			'contact_number' => Yii::t('app', 'Contact Number'),
			'store_address' => Yii::t('app', 'Store Address'),
			'link' => Yii::t('app', 'Link'),
			'discount_code' => Yii::t('app', 'Discount Code'),
			'is_owner' => Yii::t('app', 'Is Owner'),
			'image' => Yii::t('app', 'Image'),
			'deal_type_id' => Yii::t('app', 'Deal Type ID'),
			'like_number' => Yii::t('app', 'Like Number'),
			'dislike_number' => Yii::t('app', 'Dislike Number'),
			'comment_number' => Yii::t('app', 'Comment Number'),
			'view_number' => Yii::t('app', 'View Number'),
			'deal_begin_date' => Yii::t('app', 'Deal Begin Date'),
			'deal_end_date' => Yii::t('app', 'Deal End Date'),
			'create_datetime' => Yii::t('app', 'Create Date Time'),
			'modify_datetime' => Yii::t('app', 'Modify Date Time'),
			'status' => Yii::t('app', 'Status'),
		];
	}

	public function getPostType()
	{
		return $this->hasMany(PostType::className(), ['id' => 'post_type_id'])->viaTable('post_type_allocation', ['post_id' => 'id']);
	}

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function getDealType()
	{
		return $this->hasOne(DealType::className(), ['id' => 'deal_type_id']);
	}

	public static function getStatusOptions($key = null)
	{
		$options = [
			self::STATUS_APPROVED => 'Approved',
			self::STATUS_UNAPPROVED => 'Unapproved',
			self::STATUS_BANNED => 'Banned',
			self::STATUS_UNLIKED => 'Unliked',
		];

		if ($key === null) {
			return $options;
		}

		return (isset($options[$key])) ? $options[$key] : null;
	}

	public function increaseViewNumber()
	{
		$this->view_number++;
		$this->update(false, ['view_number']);
	}

	public function savePostType($postTypes)
	{
		if (!$this->id || empty($postTypes)) {
			return false;
		}

		if (!is_array($postTypes)) {
			$postTypes = [$postTypes];
		}

		$data = [];
		foreach ($postTypes as $type) {
			$data[] = [$this->id, $type];
		}

		$connection = \Yii::$app->db;
		return $connection->createCommand()->batchInsert('post_type_allocation', ['post_id', 'post_type_id'], $data)->execute();
	}
}
