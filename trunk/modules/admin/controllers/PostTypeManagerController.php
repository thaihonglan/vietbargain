<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\PostType;
use yii\data\ActiveDataProvider;
use app\components\Controller;
use yii\web\NotFoundHttpException;
use app\models\Post_type;

/**
 * PostTypeManagerController implements the CRUD actions for PostType model.
 */
class PostTypeManagerController extends Controller
{
    public function behaviors()
    {
        return [];
    }

    /**
     * Lists all PostType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new PostType();
//         print_r($model);exit;
        $dataProvider = new ActiveDataProvider([
            'query' => PostType::find(),
        ]);

        $this->getPostTypeJsTree();

        return $this->render('index', [
            'model' => $model,
            'data' => $this->getPostTypeJsTree(),
        ]);
    }

    /**
     * Creates a new PostType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = 0)
    {
        if ($id != "0") {
            if (!$parentPostType = PostType::find()->where(['id' => $id])->one()) {
                $id = 0;
            }
        }

        if ($id != 0) {
            $parentName = $parentPostType->getName();
        } else {
            $parentName = 'Root';
        }

        $model = new PostType();
        $model->setScenario('create');

        $model->parent_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'parentName' => $parentName,
            ]);
        }
    }

    /**
     * Updates an existing PostType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PostType model.
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
     * Finds the PostType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PostType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Get PostType list as JsTree format
     * @return array
     */
    protected function getPostTypeJsTree()
    {
        $postTypeList = PostType::find()->all();
        list($lang) = explode('-', \Yii::$app->language);

        $data = [
            [
                'id' => '0',
                'parent' => '#',
                'text' => 'Root'
            ]
        ];

        foreach ($postTypeList as $type) {
            $data[] = [
                'id' => $type['id'],
                'parent' => $type['parent_id'],
                'text' => $type['name_' . $lang]
            ];
        }

        return $data;
    }
}
