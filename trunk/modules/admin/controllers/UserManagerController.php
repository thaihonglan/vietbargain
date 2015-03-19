<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\User;
use app\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserManagerController implements the CRUD actions for User model.
 */
class UserManagerController extends Controller
{
	public $defaultAction = 'index';

	public function behaviors()
	{
		return [];
	}

	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$model = new User();
		$dataProvider = $model->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'model' => $model,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
// 	public function actionCreate()
// 	{

// 		$model = new user();

// 		if ($model->load(Yii::$app->request->post()) && $model->signup()) {
// 			return $this->redirect(['index']);
// 		} else {
// 			return $this->render('create', [
// 				'model' => $model,
// 			]);
// 		}
// 	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			\Yii::$app->getSession()->setFlash('update_success',  \Yii::t('admin', 'Update success.'));
			return $this->redirect(['update', 'id' => $model->id]);
		} else {
			return $this->render('update', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		if ($model->delete()) {
			\Yii::$app->getSession()->setFlash('account_delete',  $model->email);
			\Yii::$app->getSession()->setFlash('update_success',  \Yii::t('admin', 'Delete success account '));
		}
		return $this->redirect(['index']);

	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
