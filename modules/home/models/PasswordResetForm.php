<?php
namespace app\modules\home\models;

use Yii;
use app\models\User;
use app\models\Request;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetForm extends Model
{
    public $email;
    public $captcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],

            [['email', 'captcha'], 'required'],

            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'targetAttribute' => 'email',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => Yii::t('home', 'There is no user with such email.')
            ],

            ['captcha', 'captcha'],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        if ($this->validate()) {
            /* @var $user User */
            $user = User::findOne([
                'status' => User::STATUS_ACTIVE,
                'email' => $this->email,
            ]);

            if ($user) {
                $request = new Request();
                $confirmKey = $request->generateKey($user->id, Request::TYPE_RESET_PASSWORD);

                return Yii::$app->mailSender->sendUserResetPasswordMail($user, $confirmKey);
            }
        }

        return false;
    }
}
