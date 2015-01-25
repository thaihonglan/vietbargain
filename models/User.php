<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $type
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
 * @property string $create_datetime
 * @property integer $status
 * @property string $confirmPassword
 */
class User extends \app\components\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 2;

    const TYPE_NORMAL = 1;
    const TYPE_POWER = 2;
    const TYPE_PARTNER = 3;
    
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
            [['city_id', 'age',  'status'], 'integer'],
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
            'type' => Yii::t('admin', 'User rights'),
            'email' => Yii::t('admin', 'Email'),
            'password' => Yii::t('admin', 'Password'),
            'facebook_login_id' => Yii::t('admin', 'Facebook Login ID'),
            'first_name' => Yii::t('admin', 'First Name'),
            'last_name' => Yii::t('admin', 'Last Name'),
            'identifier' => Yii::t('admin', 'Identifier'),
            'city_id' => Yii::t('admin', 'City ID'),
            'address' => Yii::t('admin', 'Address'),
            'age' => Yii::t('admin', 'Age'),
            'contact_number' => Yii::t('admin', 'Contact Number'),
            'avatar' => Yii::t('admin', 'Avatar'),
            'create_datetime' => Yii::t('admin', 'Create Datetime'),
            'status' => Yii::t('admin', 'Status'),
        ];
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $this->encryptPassword($password);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
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
    
    /**
     * List type
     * @return array:
     */
    private function _get_uset_type () {
    	$types = array();
    	return $types;
    }
    
    /**
     *
     * @param string $key
     * @return content list status or single type by $key
     */
    public static function getStatus_by_key($key = null)
    {
    	$array = [
	    	self::STATUS_INACTIVE => Yii::t('model', 'Inactive'),
	    	self::STATUS_ACTIVE => Yii::t('model', 'Active'),
	    	self::STATUS_BANNED => Yii::t('model', 'Banner'),
    	];
    
    	if (isset($key)) {
    		if (isset($array[$key])) 
    			return $array[$key];
    	}
    
    	return null;
    }
    
    /**
     * 
     * @param string $key
     * @return content list type or single type by $key
     */
    public static function getType_by_key($key = null)
    {
    	$array = [
	    	self::TYPE_NORMAL  => Yii::t('model', 'Normal'),
	    	self::TYPE_PARTNER => Yii::t('model', 'Parnet'),
	    	self::TYPE_POWER   => Yii::t('model', 'Power'),
    	];
    
    	if (isset($key)) {
    		if (isset($array[$key])) 
    			return $array[$key];
    	}
    	return null;
    }
    
    /**
     *
     * @return content list type
     */
    public static function getTypes()
    {
    	return $array = [
	    	self::TYPE_NORMAL  => Yii::t('model', 'Normal'),
	    	self::TYPE_PARTNER => Yii::t('model', 'Parnet'),
	    	self::TYPE_POWER   => Yii::t('model', 'Power'),
    	];
    }
    
    /**
     *
     * @return content list status
     */
    public static function getStatus()
    {
    	return $array = [
	    	self::STATUS_INACTIVE => Yii::t('model', 'Inactive'),
	    	self::STATUS_ACTIVE => Yii::t('model', 'Active'),
	    	self::STATUS_BANNED => Yii::t('model', 'Banner'),
    	];
    }
}
