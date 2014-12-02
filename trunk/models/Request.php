<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $request_type
 * @property string $request_key
 * @property integer $status
 */
class Request extends \app\components\ActiveRecord
{
    const TYPE_REGISTER_CONFIRM = 1;
    const TYPE_RESET_PASSWORD = 2;

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
    public function rules()
    {
        return [
            [['user_id', 'request_type', 'status'], 'integer'],
            [['request_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'request_type' => Yii::t('app', 'Request Type'),
            'request_key' => Yii::t('app', 'Request Key'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function generateKey($userId, $requestType)
    {
        if ($existRequest = self::findOne(['user_id' => $userId, 'request_type' => $requestType, 'status' => self::STATUS_UNUSED])) {
            return $existRequest->request_key;
        }

        $this->user_id = $userId;
        $this->request_type = $requestType;
        $this->request_key = Yii::$app->security->generateRandomString(32);

        if ($this->save()) {
            return $this->request_key;
        }

        return false;
    }


}
