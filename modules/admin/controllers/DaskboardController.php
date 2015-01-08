<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Dashboard;

class DaskboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Dashboard();
        return $this->render('index', [
            'model' => $model
        ]);
    }
}
?>


