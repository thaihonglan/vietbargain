<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\User;
use yii\helpers\Url;

class MailSender extends Component
{
    /**
     * Send confirm mail
     * @param User $user
     * @param string $confirmKey
     * @return boolean
     */
    public function sendUserRegisterConfirmMail($user, $confirmKey)
    {
        $message = Yii::$app->mailer->compose('home/'.Yii::$app->language.'/user-register-confirm', [
            'user' => $user,
            'confirmLink' => Url::to(['auth/confirm-register', 'k' => $confirmKey], true),
        ]);

        return $message->setFrom($user->email)
                ->setTo($user->email)
                ->setSubject('Message subject')
                ->send();
    }

    public function sendUserResetPasswordMail($user, $confirmKey)
    {
        $message = Yii::$app->mailer->compose('home/'.Yii::$app->language.'/user-reset-password', [
            'user' => $user,
            'confirmLink' => Url::to(['auth/confirm-reset-password', 'k' => $confirmKey], true),
        ]);

        return $message->setFrom($user->email)
                       ->setTo($user->email)
                       ->setSubject('Message subject')
                       ->send();
    }
}