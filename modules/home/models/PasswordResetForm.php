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

    public $password;
    public $confirmPassword;

    private $_confirmRequest = null;

    private $_errorMessage = null;
    private $_successMessage = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Rules in main form
            ['email', 'filter', 'filter' => 'trim'],

            [['email', 'captcha'], 'required', 'on' => 'main'],

            ['email', 'email', 'on' => 'main'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'targetAttribute' => 'email',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => Yii::t('home', 'There is no user with such email.'),
                'on' => 'main'
            ],

            ['captcha', 'captcha', 'on' => 'main'],

            // Rules in confirm form
            [['password', 'confirmPassword'], 'required', 'on' => 'confirm'],
            ['password', 'compare', 'compareAttribute' => 'confirmPassword', 'on' => 'confirm'],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was sent
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

    public function loadConfirmKey($key = null)
    {
        if (!$key) {
            $this->_errorMessage = 'The confirm key is needed!';
            return false;
        }

        $confirmRequest = Request::find()->where(['request_key' => $key, 'request_type' => Request::TYPE_RESET_PASSWORD])
                                         ->one();

        if (!$confirmRequest) {
            $this->_errorMessage = 'This confirm key is invalid!';
            return false;
        }

        if ($confirmRequest->status == Request::STATUS_USED) {
            $this->_errorMessage = 'This confirm key has been used!';
            return false;
        }

        $this->_confirmRequest = $confirmRequest;
        return true;
    }

    /**
     * Check the confirm key and reset password
     *
     * @param string $key
     * @return boolean whether password was reset
     */
    public function confirm()
    {
        if ($this->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();

            try {
                $user = new User();
                $user = User::find()->where(['id' => $this->_confirmRequest->user_id])->one();

                $user->setPassword($this->password);
                $user->save(false, ['password']);

                $this->_confirmRequest->status = Request::STATUS_USED;
                $this->_confirmRequest->save(false, ['status']);

                $transaction->commit();
                $this->_successMessage = 'You have reset password successfully';
                return true;
            } catch(\Exception $e) {
                $transaction->rollBack();
                $this->_errorMessage = 'Something go wrong! Please try again a few minutes later.';
                throw $e;
            }
        }

        return false;
    }

    /**
     * Get message if error occurs
     *
     * @return boolean
     */
    public function getErrorMessage()
    {
        return ($this->_errorMessage) ? $this->_errorMessage : false;
    }

    /**
     * Get message if success
     *
     * @return boolean
     */
    public function getSuccessMessage()
    {
        return ($this->_successMessage) ? $this->_successMessage : false;
    }
}
