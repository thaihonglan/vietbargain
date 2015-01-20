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
			'confirmLink' => Url::to(['confirmation/register', 'k' => $confirmKey], true),
		]);

		return $message->setFrom($user->email)
					->setTo($user->email)
					->setSubject('Registration confirmation')
					->send();
	}

	public function sendUserResetPasswordMail($user, $confirmKey)
	{
		$message = Yii::$app->mailer->compose('home/'.Yii::$app->language.'/user-reset-password', [
			'user' => $user,
			'confirmLink' => Url::to(['confirmation/recover-password', 'k' => $confirmKey], true),
		]);

		return $message->setFrom($user->email)
					->setTo($user->email)
					->setSubject('Resetting password confirmation')
					->send();
	}

	public function sendUserUpdateEmailMail($user, $confirmKey, $newEmail)
	{
		$message = Yii::$app->mailer->compose('home/'.Yii::$app->language.'/user-update-email', [
			'user' => $user,
			'confirmLink' => Url::to(['confirmation/update-email', 'k' => $confirmKey], true),
			'newEmail' => $newEmail,
		]);

		return $message->setFrom($user->email)
					->setTo($user->email)
					->setSubject('Update email confirmation')
					->send();
	}
}