<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Admin;
use yii\data\ActiveDataProvider;
use app\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminManagerController implements the CRUD actions for Admin model.
 */
class AdminManagerController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all Admin models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$this->saveBacklink('admin-manager/index');

		$dataProvider = new ActiveDataProvider([
			'query' => Admin::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Creates a new Admin model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Admin();
		$model->setScenario('create');

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect([$this->getBacklink('admin-manager/index')]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Admin model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$model->setScenario('update');

		$attributes = $model->attributes();
		if ($post = Yii::$app->request->post('Admin')) {
			if ($post['password'] == '') {
				$key = array_search('password', $attributes);
				if (false !== $key) {
					unset($attributes[$key]);
				}
			}

			$model->password = $post['password'];
		} else {
			$model->password = '';
		}

		if ($model->load(Yii::$app->request->post()) && $model->save(true, $attributes)) {
			return $this->redirect([$this->getBacklink('admin-manager/index')]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Admin model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Admin model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Admin the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Admin::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
