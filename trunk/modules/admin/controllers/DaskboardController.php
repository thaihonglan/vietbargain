<?php

namespace app\modules\admin\controllers;

class DaskboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
