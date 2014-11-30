<?php
namespace app\modules\home\models;

use yii\base\Model;
use Yii;
use app\models\DealType;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class TopicForm extends Model
{
	public $title;
	public $content;
	public $postType;
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
			[['title', 'discountCode'], 'filter', 'filter' => 'trim'],

			[['title', 'content', 'postType', 'discountCode', 'dealType', 'dealBeginDate', 'dealEndDate'], 'required'],
			[['title', 'discountCode'], 'string', 'max' => 32],
			['link', 'url'],
			['isOwner', 'boolean'],
			[['dealBeginDate', 'dealEndDate'], 'date', 'format' => 'd-m-Y'],

			['dealBeginDate', 'compare', 'compareAttribute' => 'dealEndDate', 'operator' => '<=', 'skipOnEmpty' => true],
			['dealEndDate', 'compare', 'compareAttribute' => 'dealBeginDate', 'operator' => '>='],

			['postType', 'exist', 'targetClass' => '\app\models\PostType'],
			['dealType', 'exist', 'targetClass' => '\app\models\DealType'],
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

	public function getDealTypeOptions()
	{
		static $options = null;

		if ($options === null) {
			list($lang) = explode('-', \Yii::$app->language);
			$dealTypeList = DealType::find()->all();
			$options = ArrayHelper::map($dealTypeList, 'id', 'name_' . $lang);
		}

		return $options;
	}
}
