<?php
namespace app\modules\home\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class TopicForm extends Model
{
	public $title;
	public $content;
	public $type;
	public $contactNumber;
	public $storeAddress;
	public $link;
	public $discountCode;
	public $isOwner;
	public $dealType;
	public $dealBeginDate;
	public $dealEndDate;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'content', 'type', 'discountCode', 'dealType', 'dealBeginDate', 'dealEndDate'], 'required'],
			[['title'], 'string', 'max' => 32],
			[['dealBeginDate', 'dealEndDate'], 'date', 'format' => 'd-m-Y'],

			['type', 'exist', 'targetClass' => '\app\models\PostType', 'message' => 'This email address has already been taken.'],
// 			['city', 'exist', 'targetClass' => '\app\models\City', 'targetAttribute' => 'id'],
		];
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function save()
	{
		if ($this->validate()) {

		}

		return null;
	}
}
