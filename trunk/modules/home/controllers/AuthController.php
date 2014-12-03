<?php

namespace app\modules\home\controllers;

use Yii;
use yii\web\Controller;
use app\modules\home\models\LoginForm;
use app\modules\home\models\SignupForm;
use app\modules\home\models\PasswordResetForm;
use app\models\City;
use app\models\Request;
use app\models\User;

class AuthController extends Controller
{
    public $layout = 'main';

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goBack();
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['login']);
        } else {
            $cityList = City::find()->asArray()->all();

            return $this->render('register', [
                'model' => $model,
                'cityList' => $cityList,
            ]);
        }
    }

    public function actionConfirmRegister($k = null)
    {
        if ($k) {
            $confirmRequest = Request::find()->where(['request_key' => $k, 'request_type' => Request::TYPE_REGISTER_CONFIRM])
                                            ->one();


            if ($confirmRequest && ($confirmRequest->status == Request::STATUS_UNUSED)) {
                $user = User::find()->where(['id' => $confirmRequest->user_id])->one();

                $user->status = User::STATUS_ACTIVE;
                if ($user->save(false, ['status'])) {
                    $confirmRequest->status = Request::STATUS_USED;
                    $confirmRequest->save();

                    $message = Yii::t('admin', 'You have completed the registration.');
                } else {
                    $message = Yii::t('admin', 'Something go wrong. Please try again a few minutes later.');
                }
            } else {
                $message = Yii::t('admin', 'This confirm key is invalid!');
            }
        } else {
            $message = Yii::t('admin', 'This confirm key is invalid!');
        }

        return $this->render('confirm-register', [
            'message' => $message,
        ]);
    }

    public function actionRecoverPassword()
    {
        $model = new PasswordResetForm();
        if ($model->load(Yii::$app->request->post()) && $model->sendEmail()) {
            return $this->redirect('/');
        } else {
            return $this->render('recover-password', [
                'model' => $model,
            ]);
        }
    }
}
