<?php
namespace app\modules\home\models;

use yii\base\Model;
use Yii;
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
    public $postType;
    public $contactNumber;
    public $storeAddress;
    public $link;
    public $discountCode;
    public $isOwner;
    public $dealType;
    public $dealBeginDate;
    public $dealEndDate;
    public $image;

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
            [['dealBeginDate', 'dealEndDate'], 'date', 'format' => 'php:d-m-Y'],

            ['dealBeginDate', 'compare', 'compareAttribute' => 'dealEndDate', 'operator' => '<=', 'skipOnEmpty' => true],
            ['dealEndDate', 'compare', 'compareAttribute' => 'dealBeginDate', 'operator' => '>=', 'skipOnEmpty' => true],

            ['postType', 'exist', 'targetClass' => '\app\models\PostType', 'targetAttribute' => 'id', 'allowArray' => true],
            ['dealType', 'exist', 'targetClass' => '\app\models\DealType', 'targetAttribute' => 'id'],

            ['image', 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png', 'skipOnEmpty' => true],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        $this->image = UploadedFile::getInstance($this, 'image');
        if ($this->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();

            try {
                $post = new Post();

                // required data
                $post->title = $this->title;
                $post->content = $this->content;
                $post->discount_code = $this->discountCode;
                $post->deal_type = $this->dealType;
                $post->deal_begin_date = Yii::$app->formatter->asDatetime($this->dealBeginDate, "php:Y-m-d");
                $post->deal_end_date = Yii::$app->formatter->asDatetime($this->dealEndDate, "php:Y-m-d");

                // optional data
                (!$this->contactNumber) OR ($post->contact_number = $this->contactNumber);
                (!$this->storeAddress) OR ($post->store_address = $this->storeAddress);
                (!$this->link) OR ($post->link = $this->link);
                (!$this->isOwner) OR ($post->is_owner = 1);

                if ($this->image) {
                    $post->image = Yii::$app->security->generateRandomString(32) . '.' . $this->image->extension;
                }

                // internal data
                $post->user_id = Yii::$app->user->getId();
                $post->status = Post::STATUS_UNAPPROVED;

                if ($post->save(false)) {
                    $post->savePostType($this->postType);
                }

                if ($this->image) {
                    if (!$this->image->saveAs(Yii::$app->params['imagePath'] . 'post/' . $post->image)) {
                        throw \Exception('Cannot upload file');
                    }
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
