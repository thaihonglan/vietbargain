<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\admin;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\ProfileManager;
/**
 * ProfileManagerController implements the CRUD actions for admin model.
 */
class ProfileManagerController extends Controller
{

    public function behaviors()
    {
        return [
        ];
    }

    /**
     * Lists all admin models.
     * @return mixed
     */
    public function actionIndex()
    {
       return $this->render('index', [
            'model' => Admin::findOne(Yii::$app->user->id),
        ]);
    }

    /**
     * Updates an existing admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEditprofile()
    {
    	$model = new ProfileManager();
    	
    	$model->setAttributes(Yii::$app->request->post('ProfileManager'), false);
    	if ($model->save()) {
    		return $this->redirect(['profile-manager/index', 'success' => '1']);
    	} else {
    		return $this->render('edit-profile', [
    				'model' => $model,
    				]);
    	}
    }
    
    /**
     * Finds the admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
