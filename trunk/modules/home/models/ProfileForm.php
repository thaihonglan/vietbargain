<?php
namespace app\modules\home\models;

use Yii;
use app\models\User;
use app\models\Request;
use app\models\City;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\image\drivers\Image;

/**
 * Profile form
 */
class ProfileForm extends Model
{
	const ACTION_UPDATE_DATA = 'update-data';
	const ACTION_UPDATE_PASSWORD = 'update-password';
	const ACTION_UPDATE_AVATAR = 'update-avatar';
	const ACTION_UPDATE_EMAIL = 'update-email';

	public $email;
	public $oldPassword;
	public $newPassword;
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
	 * @var \app\models\User
	 */
	private $_user;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			// Scenario: update data
			[['firstName', 'lastName', 'city'], 'required', 'on' => self::ACTION_UPDATE_DATA],

			[['firstName', 'lastName', 'identifier', 'contactNumber'], 'string', 'max' => 32, 'on' => self::ACTION_UPDATE_DATA],
			[['address'], 'string', 'max' => 128, 'on' => self::ACTION_UPDATE_DATA],
			[['city', 'age'], 'integer', 'on' => self::ACTION_UPDATE_DATA],

			['city', 'exist', 'targetClass' => '\app\models\City', 'targetAttribute' => 'id', 'on' => self::ACTION_UPDATE_DATA],

			// Scenario: update email
			['email', 'filter', 'filter' => 'trim', 'on' => self::ACTION_UPDATE_DATA],
			['email', 'required', 'on' => self::ACTION_UPDATE_EMAIL],
			['email', 'email', 'on' => self::ACTION_UPDATE_EMAIL],
			['email', 'string', 'max' => 32, 'on' => self::ACTION_UPDATE_DATA],
			['email', 'unique', 'targetClass' => '\app\models\User', 'filter' => ['!=', 'email', $this->_user->email], 'message' => 'This email address has already been taken.', 'on' => self::ACTION_UPDATE_EMAIL],

			// Scenario: update password
			[['oldPassword', 'newPassword', 'confirmPassword'], 'required', 'on' => self::ACTION_UPDATE_PASSWORD],
			[['oldPassword', 'newPassword', 'confirmPassword'], 'string', 'max' => 32, 'on' => self::ACTION_UPDATE_PASSWORD],
			['oldPassword', function ($attribute, $params) {
				if (!Yii::$app->security->validatePassword($this->$attribute, $this->_user->password)) {
					$this->addError($attribute, 'Your old password is not correct.');
				}
			}, 'on' => self::ACTION_UPDATE_PASSWORD],
			['newPassword', 'compare', 'compareAttribute' => 'confirmPassword', 'on' => self::ACTION_UPDATE_PASSWORD],
			['newPassword', 'string', 'min' => 6, 'on' => self::ACTION_UPDATE_PASSWORD],

			// Scenario: update avatar
			['avatar', 'required', 'on' => self::ACTION_UPDATE_AVATAR],
			['avatar', 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png', 'on' => self::ACTION_UPDATE_AVATAR],
		];
	}

	public function __construct() {
		$this->_user = User::findOne(Yii::$app->user->id);

		if (empty($this->_user)) {
			return false;
		}
	}

	private function _loadData()
	{
		$action = Yii::$app->request->post('action');

		if ($action != self::ACTION_UPDATE_DATA) {
			$this->firstName = $this->_user->first_name;
			$this->lastName = $this->_user->last_name;
			$this->identifier = $this->_user->identifier;
			$this->city = $this->_user->city_id;
			$this->address = $this->_user->address;
			$this->age = $this->_user->age;
			$this->contactNumber = $this->_user->contact_number;
		}

		if ($action != self::ACTION_UPDATE_EMAIL) {
			$this->email = $this->_user->email;
		}

		$this->avatar = $this->_user->avatar;
	}

	public function getCityOptions()
	{
		return ArrayHelper::map(City::find()->asArray()->all(), 'id', 'name');
	}

	private function _updateIdentity()
	{
		$newIdentity = User::findIdentity($this->_user->id);
		Yii::$app->user->setIdentity($newIdentity);
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function save()
	{
		$action = Yii::$app->request->post('action');
		if (!$action || (!in_array($action, [self::ACTION_UPDATE_DATA, self::ACTION_UPDATE_AVATAR, self::ACTION_UPDATE_PASSWORD, self::ACTION_UPDATE_EMAIL]))) {
			$this->_loadData();
			return;
		}

		$this->setScenario($action);

		if ($action == self::ACTION_UPDATE_AVATAR) {
			$this->avatar = UploadedFile::getInstance($this, 'avatar');
		}

		if ($this->validate()) {

			switch ($action) {
				case self::ACTION_UPDATE_DATA:
					$this->_user->first_name = $this->firstName;
					$this->_user->last_name = $this->lastName;
					$this->_user->city_id = $this->city;

					(!$this->identifier) OR ($this->_user->identifier = $this->identifier);
					(!$this->age) OR ($this->_user->age = $this->age);
					(!$this->contactNumber) OR ($this->_user->contact_number = $this->contactNumber);
					(!$this->address) OR ($this->_user->address = $this->address);

					$this->_user->update(false);
					$this->_updateIdentity();
					break;

				case self::ACTION_UPDATE_EMAIL:
					$request = Request::create(Request::TYPE_UPDATE_PASSWORD, $this->_user->id);
					$request->data = json_encode(['email' => $this->email]);

					$request->save(false);

					Yii::$app->mailSender->sendUserUpdateEmailMail($this->_user, $request->request_key, $this->email);
					break;

				case self::ACTION_UPDATE_PASSWORD:
					$this->_user->setPassword($this->newPassword);

					$this->_user->update(false);
					$this->_updateIdentity();
					break;

				case self::ACTION_UPDATE_AVATAR:
					$this->_user->avatar = Yii::$app->security->generateRandomString(32) . '.' . $this->avatar->extension;
					$this->_user->update(false);
					$this->_updateIdentity();

					$avatar = Yii::$app->basePath . '/web' . Yii::$app->params['userImagePath']['original'] . $this->_user->avatar;
					$this->avatar->saveAs($avatar);

					// resize image
					$image = Yii::$app->image->load($avatar);

					$image->resize('120', '120', Image::INVERSE)->save(Yii::$app->basePath . '/web' . Yii::$app->params['userImagePath']['scaled'] . $this->_user->avatar);
					$image->resize('60', '60', Image::INVERSE)->save(Yii::$app->basePath . '/web' . Yii::$app->params['userImagePath']['icon'] . $this->_user->avatar);
					break;
			}

			return true;
		}

		$this->_loadData();
		return null;
	}
}
