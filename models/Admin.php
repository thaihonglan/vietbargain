<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property integer $has_admin_authority
 * @property integer $has_user_authority
 * @property integer $has_deal_authority
 * @property integer $has_dashboard_authority
 */
class Admin extends \app\components\ActiveRecord implements \yii\web\IdentityInterface
{
	/**
	 * Temporary string store in-encrypted password
	 * @var string
	 */
	private $_password_temp = null;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'admin';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['username', 'first_name', 'last_name'], 'required'],
			['password', 'required', 'on' => 'create'],
			[['has_admin_authority', 'has_user_authority', 'has_deal_authority', 'has_dashboard_authority'], 'integer'],
			[['username', 'first_name', 'last_name'], 'string', 'max' => 32],
			[['password'], 'string', 'max' => 64],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('admin', 'ID'),
			'username' => Yii::t('admin', 'Username'),
			'password' => Yii::t('admin', 'Password'),
			'first_name' => Yii::t('admin', 'First Name'),
			'last_name' => Yii::t('admin', 'Last Name'),
			'has_admin_authority' => Yii::t('admin', 'Has Admin Authority'),
			'has_user_authority' => Yii::t('admin', 'Has User Authority'),
			'has_deal_authority' => Yii::t('admin', 'Has Deal Authority'),
			'has_dashboard_authority' => Yii::t('admin', 'Has Dashboard Authority'),
		];
	}

	public function scenarios()
	{
		return [
			'create' => ['username', 'first_name', 'last_name', 'password', 'has_admin_authority', 'has_user_authority', 'has_deal_authority', 'has_dashboard_authority'],
			'update' => ['username', 'first_name', 'last_name', 'has_admin_authority', 'has_user_authority', 'has_deal_authority', 'has_dashboard_authority'],
		];
	}

	public function beforeSave($insert) {
		$this->_password_temp = $this->password;
		$this->password = $this->encryptPassword($this->password);

		return parent::beforeSave($insert);
	}

	public function afterSave($insert, $changedAttributes) {
		parent::afterSave($insert, $changedAttributes);

		$this->password = $this->_password_temp;
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
		return '';
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
