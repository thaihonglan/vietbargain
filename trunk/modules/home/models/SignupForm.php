<?php
namespace app\modules\home\models;

use app\models\User;
use app\models\Request;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $confirmPassword;
    public $firstName;
    public $lastName;
    public $identifier;
    public $city;
    public $address;
    public $age;
    public $contactNumber;
    public $captcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],

            [['email', 'password', 'confirmPassword', 'firstName', 'lastName', 'identifier', 'city', 'captcha'], 'required'],

            [['email', 'firstName', 'lastName', 'identifier', 'contactNumber'], 'string', 'max' => 32],
            [['address'], 'string', 'max' => 128],
            [['city', 'age'], 'integer'],

            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'compare', 'compareAttribute' => 'confirmPassword'],
            ['password', 'string', 'min' => 6],

            ['city', 'exist', 'targetClass' => '\app\models\City', 'targetAttribute' => 'id'],

            ['captcha', 'captcha'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();

            try {
                $user = new User();
                $user->email = $this->email;
                $user->setPassword($this->password);
                $user->first_name = $this->firstName;
                $user->last_name = $this->lastName;
                $user->city_id = $this->city;
                $user->status = User::STATUS_INACTIVE;

                (!$this->identifier) OR ($user->identifier = $this->identifier);
                (!$this->age) OR ($user->age = $this->age);
                (!$this->contactNumber) OR ($user->contact_number = $this->contactNumber);
                (!$this->address) OR ($user->address = $this->address);

                $user->insert(false);

                $request = new Request();
                $confirmKey = $request->generateKey($user->id, Request::TYPE_REGISTER_CONFIRM);

                $transaction->commit();
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

            Yii::$app->mailSender->sendUserRegisterConfirmMail($user, $confirmKey);

            return $user;
        }

        return null;
    }
}
