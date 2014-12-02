<?php
namespace app\modules\home\models;

use yii\base\Model;
use Yii;
use app\models\DealType;
use yii\helpers\ArrayHelper;
use app\models\PostType;

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

	private $_lang = null;

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

			['postType', 'exist', 'targetClass' => '\app\models\PostType', 'targetAttribute' => 'id'],
			['dealType', 'exist', 'targetClass' => '\app\models\DealType', 'targetAttribute' => 'id'],
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
			$options = [];
			$dealTypeList = DealType::find()->all();
			$options = ArrayHelper::map($dealTypeList, 'id', 'name_' . $this->getLang());
		}

		return $options;
	}

	public function getPostTypeOptions()
	{
		static $options = null;

		if ($options === null) {
			$options = [];
			$postTypeList = PostType::find()->all();

			$options = $this->_loopOptions($postTypeList);
		}

		return $options;
	}

	private function _loopOptions(&$options, $parent_id = 0)
	{
		$return = [];
		foreach ($options as $key => $option) {
			if ($option->parent_id == $parent_id) {
				if ($option->is_parent) {
					$return[$option->{'name_'.$this->getLang()}] = $this->_loopOptions($options, $option->id);
				} else {
					$return[$option->id] = $option->{'name_'.$this->getLang()};
				}
			}
		}
		return $return;
	}

	private function getLang()
	{
		if ($this->_lang === null) {
			list($this->_lang) = explode('-', \Yii::$app->language);
		}

		return $this->_lang;
	}
}
