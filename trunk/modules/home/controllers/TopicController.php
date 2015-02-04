<?php

namespace app\modules\home\controllers;

use Yii;
use app\modules\home\models\TopicForm;
use app\modules\home\models\CommentForm;
use app\modules\home\models\PostSearch;
use app\models\PostType;
use app\models\Post;
use yii\web\NotFoundHttpException;
use app\models\Comment;
use yii\data\Pagination;

class TopicController extends \app\modules\home\components\Controller
{
	protected $_params = [
		'commentPageSize' => 5
	];

	public $defaultAction = 'show';

	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['new'],
				'rules' => [
					[
						'actions' => ['new'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => \yii\filters\VerbFilter::className(),
				'actions' => [
					'comment-post'  => ['post'],
				],
			],
		];
	}

	public function actionShow()
	{
		$searchModel = new PostSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		if ($curPostTypeId = Yii::$app->request->get('pt')) {
			foreach (PostType::findFull() as $item) {
				if ($item->id == $curPostTypeId) {
					$this->data['currentPostTypeName'] = $item->name;
					break;
				}
			}
		}

		return $this->render('show', [
			'dataProvider' => $dataProvider
		]);
	}

	public function actionNew()
	{
		$model = new TopicForm();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(Yii::$app->request->cookies->getValue('home/preLink'));
		} else {
			return $this->render('new', [
				'model' => $model,
			]);
		}
	}

	public function actionView()
	{
		if (!$model = Post::find()->joinWith('user')->where(['post.id' => Yii::$app->request->get('p')])->one()) {
			throw new NotFoundHttpException('The requested page does not exist.');
		}

		if ($model->user->id != Yii::$app->user->id) {
			$model->increaseViewNumber();
		}

		$commentQuery = Comment::find()->joinWith('user')->where(['post_id' => Yii::$app->request->get('p'), 'is_approved' => 1]);
		$pages = new Pagination([
			'totalCount' => $commentQuery->count(),
			'pageParam' => 'cm-p',
			'pageSizeParam' => false,
		]);
		$pages->setPageSize($this->_params['commentPageSize']);

		$comments = $commentQuery->offset($pages->offset)
								->limit($pages->limit)
								->all();

		if (!Yii::$app->user->isGuest) {
			$commentForm = new CommentForm();
		} else {
			$commentForm = null;
		}

		return $this->render('view', [
			'model' => $model,
			'comments' => $comments,
			'commentForm' => $commentForm,
			'pages' => $pages
		]);
	}

	public function actionCommentPost()
	{
		if (!Yii::$app->request->isAjax) {
			throw new NotFoundHttpException('The requested page does not exist.');
		}

		$model = new CommentForm();
		if (!$model->setPostId(Yii::$app->request->post('postId'))) {
			return $this->ajaxRespone(0, ['Something wrong occurs!', 'Wrong post ID!']);
		}

		if (!$model->load(Yii::$app->request->post(), '') || !$model->save()) {
			return $this->ajaxRespone(0, ['Something wrong occurs!', 'Cannot save!']);
		}

		return $this->ajaxRespone(1);
	}
}
