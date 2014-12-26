<?php
namespace app\modules\home\models;

use Yii;
use app\models\User;
use app\models\Request;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\image\drivers\Image;

/**
 * Profile form
 */
class ProfileForm extends Model
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
	public $avatar;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['email', 'filter', 'filter' => 'trim'],

			[['email', 'firstName', 'lastName', 'identifier', 'contactNumber'], 'string', 'max' => 32],
			[['address'], 'string', 'max' => 128],
			[['city', 'age'], 'integer'],

			['email', 'email'],
			['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

			['password', 'compare', 'compareAttribute' => 'confirmPassword', 'skipOnEmpty' => true],
			['password', 'string', 'min' => 6],

			['city', 'exist', 'targetClass' => '\app\models\City', 'targetAttribute' => 'id'],

			['captcha', 'captcha'],

			['avatar', 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png', 'skipOnEmpty' => true],
		];
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function signup()
	{
		$this->avatar = UploadedFile::getInstance($this, 'avatar');

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

				if ($this->avatar) {
					$user->avatar = Yii::$app->security->generateRandomString(32) . '.' . $this->avatar->extension;
				}

				$user->insert(false);

				$request = new Request();
				$confirmKey = $request->generateKey($user->id, Request::TYPE_REGISTER_CONFIRM);

				if ($this->avatar) {
					// upload image
					$avatar = Yii::$app->basePath . '/web' . Yii::$app->params['userImagePath']['original'] . $user->avatar;
					if (!$this->avatar->saveAs($avatar)) {
						throw \Exception('Cannot upload file');
					}

					// resize image
					$image = Yii::$app->image->load($avatar);

					$image->resize('120', '120', Image::INVERSE)->save(Yii::$app->basePath . '/web' . Yii::$app->params['userImagePath']['scaled'] . $user->avatar);
					$image->resize('60', '60', Image::INVERSE)->save(Yii::$app->basePath . '/web' . Yii::$app->params['userImagePath']['icon'] . $user->avatar);
				}

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
