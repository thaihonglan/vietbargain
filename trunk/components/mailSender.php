<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\User;
use app\models\Request;
use yii\helpers\Url;

class MailSender extends Component
{
	/**
	 * Send confirm mail
	 * @param User $user
	 */
	public function sendUserRegisterConfirmMail($user)
	{
		$request = new Request();
		$confirmKey = $request->generate($user->id, Request::TYPE_REGISTER_CONFIRM);

		$message = Yii::$app->mailer->compose('home/user-register-confirm', [
			'user' => $user,
			'confirmLink' => Url::to(['auth/confirm-register', 'k' => $confirmKey], true),
		]);

		return $message->setFrom($user->email)
				->setTo($user->email)
				->setSubject('Message subject')
				->send();
	}

	private function getContent($mailType, $replace = array())
	{

	}
}