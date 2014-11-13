<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\City;
use yii\data\ActiveDataProvider;
use app\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * CityManagerController implements the CRUD actions for City model.
 */
class CityManagerController extends Controller
{
	public function behaviors()
	{
		return [];
	}

	/**
	 * Lists all City models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => City::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Creates a new City model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new City();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing City model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing City model.
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
	 * Finds the City model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return City the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = City::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
