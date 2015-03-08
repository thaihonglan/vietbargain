<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $request_type
 * @property string $request_key
 * @property string $data
 * @property integer $status
 */
class Request extends \app\components\ActiveRecord
{
	const TYPE_REGISTER_CONFIRM = 1;
	const TYPE_RESET_PASSWORD = 2;
	const TYPE_UPDATE_PASSWORD = 3;

	const STATUS_UNUSED = 0;
	const STATUS_USED = 1;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'request';
	}

	/**
	 * @inheritdoc
	 */
	public function attributes()
	{
		return [
			'id',
			'user_id',
			'request_type',
			'request_key',
			'data',
			'status'
		];
	}

	public function generateKey($userId, $requestType, $data = null)
	{
		$existRequest = self::findOne(['user_id' => $userId, 'request_type' => $requestType, 'status' => self::STATUS_UNUSED]);
		if ($existRequest) {
			return $existRequest->request_key;
		}

		$this->user_id = $userId;
		$this->request_type = $requestType;
		$this->request_key = Yii::$app->security->generateRandomString(32);
		(!$data) OR ($this->data = $data);

		if ($this->save()) {
			return $this->request_key;
		}

		return false;
	}

	/**
	 * Create an user request.
	 *
	 * If the user request exists, then return
	 * @param unknown $requestType
	 * @param unknown $userId
	 * @return Request
	 */
	public static function create($requestType, $userId)
	{
		$existRequest = self::findOne(['user_id' => $userId, 'request_type' => $requestType, 'status' => self::STATUS_UNUSED]);
		if ($existRequest) {
			return $existRequest;
		}

		$request = new Request();
		$request->user_id = $userId;
		$request->request_type = $requestType;
		$request->request_key = Yii::$app->security->generateRandomString(32);

		return $request;
	}
}
