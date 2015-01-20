<?php
namespace app\modules\home\models;

use Yii;
use yii\base\Model;
use yii\db\Command;
use app\models\Comment;
use app\models\Post;

/**
 * Login form
 */
class CommentForm extends Model
{
	public $content;

	private $_postId;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['content', 'required'],
		];
	}

	public function setPostId($postId)
	{
		if (Post::find()->where(['id' => $postId])->exists()) {
			$this->_postId = $postId;
			return true;
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return boolean whether the user is logged in successfully
	 */
	public function save()
	{
		if ($this->validate()) {
			$comment = new Comment();
			$comment->content = $this->content;
			$comment->user_id = Yii::$app->user->id;
			$comment->post_id = $this->_postId;

			if (Yii::$app->user->identity->is_comment_unlimited) {
				$comment->is_approved = 1;
			}

			return $comment->save(false);
		}

		return false;
	}

}
