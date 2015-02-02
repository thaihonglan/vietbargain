<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\comment;
use app\models\User;
use app\models\Post;
use app\modules\admin\models\CommentSearch;
use app\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * CommentManagerController implements the CRUD actions for comment model.
 */
class CommentManagerController extends Controller
{
	public function behaviors()
	{
		return [];
	}

	/**
	 * Lists all comment models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new CommentSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$type = array();
		foreach (User::getTypes() as $key_type => $val_type) $type[] = ['id' => $key_type, 'name' => $val_type];

		$is_approved = array();
		foreach (comment::getStatus() as $key_type => $val_type) $is_approved[] = ['id' => $key_type, 'name' => $val_type];

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'type' => $type,
			'is_approved' => $is_approved,
		]);
	}

	/**
	 * Creates a new comment model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new comment();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing comment model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		} else {
			$status = array();
			$action_status_list = comment::getStatus();
			unset($action_status_list[comment::STATUS_APPROVED]);
			foreach ( $action_status_list as $key_status => $val_status) $status[] = ['id' => $key_status, 'name' => $val_status];
			
			return $this->render('update', [
				'model' => $model,
				'status' => $status,
			]);
		}
	}

	/**
	 * Deletes an existing comment model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = comment::find()
		->innerJoinWith(['user', 'post'])
		->andWhere(['in', 'user.status', User::STATUS_ACTIVE])
		->andWhere(['in', 'post.status', Post::STATUS_APPROVED])
		->andWhere(['IN', 'comment.is_approved', [comment::STATUS_UNAPPROVED, comment::STATUS_APPROVED]])
		->andWhere(['in', 'comment.id', $id])
		->one();
		
		if (empty($model)) {
			return $this->redirect('index');
		}
		
		return $this->render('view', [
				'model' => $model,
				]);
		
	}
	
	
	/**
	 * Deletes an existing comment model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the comment model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return comment the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = comment::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
