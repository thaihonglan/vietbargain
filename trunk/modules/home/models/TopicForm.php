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

			$names = [];
			$array = [];

			foreach ($postTypeList as $type) {
				$names[$type->id] = $type->{'name_' . $this->getLang()};
				$array[$type->parent_id][] =  $type->id;
			}

			foreach ($array as $parent_id => $id) {
				if ($parent_id != 0) {
					if (is_array($id)) {
						$options[$names[$parent_id]] = [];
					}
				}
			}
			print_r($options);
		}

		return $options;
	}

	private function _loopOptions($options, $deep, &$array, &$names)
	{
		$return = [];
		foreach ($array as $parent_id => $id) {
			if ($parent_id == 0) {
				if (is_array($id)) {
					$return[$names[$parent_id]] = $this->_loopOptions($id, ++$deep, $array, $names);
				} else {
					if (isset($array[$id])) {

					} else {
						$return[$parent_id] = $names[$id];
					}
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
