<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $facebook_login_id
 * @property string $first_name
 * @property string $last_name
 * @property string $identifier
 * @property string $city_id
 * @property string $address
 * @property integer $age
 * @property string $contact_number
 * @property string $avatar
 * @property integer $is_unlimited_user
 * @property string $create_datetime
 * @property integer $status
 */
class User extends \app\components\ActiveRecord implements \yii\web\IdentityInterface
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['city_id', 'age', 'is_unlimited_user', 'status'], 'integer'],
			[['contact_number'], 'required'],
			[['create_datetime'], 'safe'],
			[['email', 'facebook_login_id', 'first_name', 'last_name', 'identifier', 'contact_number'], 'string', 'max' => 32],
			[['password', 'avatar'], 'string', 'max' => 64],
			[['address'], 'string', 'max' => 45]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'email' => Yii::t('app', 'Email'),
			'password' => Yii::t('app', 'Password'),
			'facebook_login_id' => Yii::t('app', 'Facebook Login ID'),
			'first_name' => Yii::t('app', 'First Name'),
			'last_name' => Yii::t('app', 'Last Name'),
			'identifier' => Yii::t('app', 'Identifier'),
			'city_id' => Yii::t('app', 'City ID'),
			'address' => Yii::t('app', 'Address'),
			'age' => Yii::t('app', 'Age'),
			'contact_number' => Yii::t('app', 'Contact Number'),
			'avatar' => Yii::t('app', 'Avatar'),
			'is_unlimited_user' => Yii::t('app', 'Is Unlimited User'),
			'create_datetime' => Yii::t('app', 'Create Datetime'),
			'status' => Yii::t('app', 'Status'),
		];
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username]);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return static::findOne(['id' => $id]);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * Generates password hash from password
	 *
	 * @param string $password
	 */
	public function encryptPassword($password)
	{
		return Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->password);
	}
}
