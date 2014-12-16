<?php

namespace app\modules\home\controllers;

use Yii;
use app\modules\home\models\LoginForm;
use app\modules\home\models\SignupForm;
use app\modules\home\models\PasswordResetForm;
use app\models\City;
use app\models\Request;
use app\models\User;

class AuthController extends \app\modules\home\components\Controller
{
    public $layout = 'main';

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->request->cookies->getValue('home/preLink'));
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
        $model = new PasswordResetForm(['scenario' => 'main']);
        if ($model->load(Yii::$app->request->post()) && $model->sendEmail()) {
            return $this->redirect('/');
        } else {
            return $this->render('recover-password', [
                'model' => $model,
            ]);
        }
    }

    public function actionConfirmRecoverPassword($k = null)
    {
        $model = new PasswordResetForm(['scenario' => 'confirm']);

        if ($model->loadConfirmKey($k) && $model->load(Yii::$app->request->post())) {
            $model->confirm();
        }

        return $this->render('confirm-recover-password', [
            'model' => $model,
        ]);
    }
}
