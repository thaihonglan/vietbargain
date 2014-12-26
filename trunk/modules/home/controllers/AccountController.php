<?php

namespace app\modules\home\controllers;

class AccountController extends \app\modules\home\components\Controller
{
    public function actionEditProfile()
    {
        return $this->render('edit-profile');
    }

}
