<?php
namespace app\modules\admin\models;

use Yii;
use app\models\User;
use yii\base\Model;
use app\models\Admin;

/**
 * Profile form
 */
class ProfileManager extends Model
{
	public $username;
	public $oldPassword;
	public $newPassword;
	public $confirmPassword;
	public $first_name;
	public $last_name;

	/**
	 * @var \app\models\admin
	 */
	private $_admin;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$edit_pass = $this->oldPassword == null ? 'string' : 'required';
		
		$rules = [
			// Scenario: update data
			[['first_name', 'last_name'], 'required'],
			[['first_name', 'last_name'], 'string', 'max' => 32],

			// Scenario: update password
			[['oldPassword', 'newPassword', 'confirmPassword'], $edit_pass],
			[['oldPassword', 'newPassword', 'confirmPassword'], 'string', 'max' => 32],
			['oldPassword', function ($attribute, $params) {
				if (!Yii::$app->security->validatePassword($this->$attribute, $this->_admin->password)) {
					$this->addError($attribute, 'Your old password is not correct.');
				}
			}],
			['newPassword', 'compare', 'compareAttribute' => 'confirmPassword'],
// 			['newPassword', 'string', 'min' => 6],

		];
			
		return $rules;
	}

	public function __construct() {
		$this->_admin = Admin::findOne(Yii::$app->user->id);

		if (empty($this->_admin)) {
			return false;
		}
	}

	/**
	 * Load information of user login current
	 */
	public function _loadData()
	{
		$this->username    = $this->_admin->username;
		$this->oldPassword = '';
		$this->last_name   = $this->_admin->last_name;
		$this->first_name  = $this->_admin->first_name;
	}


	private function _updateIdentity()
	{
		$newIdentity = Admin::findIdentity($this->_admin->id);
		Yii::$app->user->setIdentity($newIdentity);
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function save()
	{
		$action = Yii::$app->request->post();
		if (!$action) {
			$this->_loadData();
			return;
		}

		if ($this->validate()) {
			$this->_admin->first_name = $this->first_name;
			$this->_admin->last_name = $this->last_name;
			
			if ($this->oldPassword != null) {
				$this->_admin->password = $this->newPassword;
			}
			
			$this->_admin->update(false);
			$this->_updateIdentity();
			return true;
		} 
	}
}
