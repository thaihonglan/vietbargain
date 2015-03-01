<?php
namespace app\modules\home\models;

use Yii;
use yii\base\Model;
use app\models\DealType;
use yii\helpers\ArrayHelper;
use app\models\PostType;
use app\models\Post;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class TopicForm extends Model
{
	public $title;
	public $content;
	public $shortContent;
	public $postType;
	public $contactNumber;
	public $storeAddress;
	public $link;
	public $discountCode;
	public $isOwner;
	public $dealType;
	public $dealBeginDate;
	public $dealEndDate;

	public $id;
	public $isNewRecord = true;
	private $_lang = null;

	public static function findOne($id)
	{
		if (!$post = Post::findOne($id)) {
			return false;
		}

		$model = new TopicForm();
		$model->title = $post->title;
		$model->content = $post->content;
		$model->shortContent = $post->short_content;
		$model->postType = ArrayHelper::getColumn($post->postType, 'id');
		$model->contactNumber = $post->contact_number;
		$model->storeAddress = $post->store_address;
		$model->link = $post->link;
		$model->discountCode = $post->discount_code;
		$model->isOwner = $post->is_owner;
		$model->dealType = $post->deal_type;
		$model->dealBeginDate = $post->deal_begin_date;
		$model->dealEndDate = $post->deal_end_date;

		$model->isNewRecord = false;
		$model->id = $id;

		return $model;
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'discountCode'], 'filter', 'filter' => 'trim'],

			[['title', 'content', 'shortContent', 'postType', 'discountCode', 'dealType', 'dealBeginDate', 'dealEndDate'], 'required'],
			[['title', 'discountCode'], 'string', 'max' => 32],
			['shortContent', 'string', 'max' => 512],
			['link', 'url'],
			['isOwner', 'boolean'],
			[['dealBeginDate', 'dealEndDate'], 'date', 'format' => 'php:d-m-Y'],

			['dealBeginDate', 'compare', 'compareAttribute' => 'dealEndDate', 'operator' => '<=', 'skipOnEmpty' => true],
			['dealEndDate', 'compare', 'compareAttribute' => 'dealBeginDate', 'operator' => '>=', 'skipOnEmpty' => true],

			['postType', 'exist', 'targetClass' => '\app\models\PostType', 'targetAttribute' => 'id', 'allowArray' => true],
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
			$transaction = \Yii::$app->db->beginTransaction();

			try {
				if ($this->isNewRecord) {
					$post = new Post();
				} else {
					$post = Post::findOne($this->id);
				}

				// required data
				$post->title = $this->title;
				$post->content = $this->content;
				$post->short_content = $this->shortContent;
				$post->discount_code = $this->discountCode;
				$post->deal_type = $this->dealType;
				$post->deal_begin_date = Yii::$app->formatter->asDatetime($this->dealBeginDate, "php:Y-m-d");
				$post->deal_end_date = Yii::$app->formatter->asDatetime($this->dealEndDate, "php:Y-m-d");

				// optional data
				(!$this->contactNumber) OR ($post->contact_number = $this->contactNumber);
				(!$this->storeAddress) OR ($post->store_address = $this->storeAddress);
				(!$this->link) OR ($post->link = $this->link);
				(!$this->isOwner) OR ($post->is_owner = 1);

				// internal data
				$post->user_id = Yii::$app->user->getId();
				$post->status = Post::STATUS_UNAPPROVED;

				if ($post->save(false)) {
					$post->savePostType($this->postType);
				}

				$transaction->commit();
				return true;
			} catch(\Exception $e) {
				$transaction->rollBack();
				throw $e;
			}
		}

		return null;
	}

	public function getDealTypeOptions()
	{
		static $options = null;

		if ($options === null) {
			$options = [];
			$dealTypeList = DealType::find()->all();
			$options = ArrayHelper::map($dealTypeList, 'id', 'name_' . DealType::getLang());
		}

		return $options;
	}

	public function getPostTypeOptions()
	{
		static $options = null;

		if ($options === null) {
			$options = $this->_preparePostTypeOptions(PostType::findAllAsFiliation());
		}

		return $options;
	}

	/**
	 *
	 * @param PostType $options
	 */
	private function _preparePostTypeOptions($items)
	{
		$options = [];

		foreach ($items as $item) {
			if ($item->is_parent) {
				$options[$item->name] = $this->_preparePostTypeOptions($item->children);
			} else {
				$options[$item->id] = $item->name;
			}
		}

		return $options;
	}
}
