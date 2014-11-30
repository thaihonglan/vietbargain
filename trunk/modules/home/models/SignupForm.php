<?php
namespace app\modules\home\models;

use app\models\User;
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

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['email', 'filter', 'filter' => 'trim'],

			[['email', 'password', 'confirmPassword', 'firstName', 'lastName', 'identifier', 'city'], 'required'],
			[['email', 'firstName', 'lastName', 'identifier', 'contactNumber'], 'string', 'max' => 32],
			[['address'], 'string', 'max' => 128],
			[['city', 'age'], 'integer'],

			['email', 'email'],
			['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

			['password', 'compare', 'compareAttribute' => 'confirmPassword'],
			['password', 'string', 'min' => 6],

			['city', 'exist', 'targetClass' => '\app\models\City', 'targetAttribute' => 'id'],
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

			$user = new User();
			$user->email = $this->email;
			$user->setPassword($this->password);
			$user->first_name = $this->firstName;
			$user->last_name = $this->lastName;
			$user->identifier = $this->identifier;
			$user->city_id = $this->city;
			$user->status = User::STATUS_INACTIVE;

			if ($this->age) {
				$user->age = $this->age;
			}

			if ($this->contactNumber) {
				$user->contact_number = $this->contactNumber;
			}

			if ($this->address) {
				$user->address = $this->address;
			}

			$user->insert(false);

			Yii::$app->mailSender->sendUserRegisterConfirmMail($user);

			return $user;
		}

		return null;
	}
}
