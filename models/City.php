<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property string $id
 * @property string $name
 * @property integer $code
 * @property string $zip
 */
class City extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'zip'], 'integer'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'name' => Yii::t('admin', 'Name'),
            'code' => Yii::t('admin', 'Code'),
            'zip' => Yii::t('admin', 'Zip'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function getcity()
    {
    	return $this->getPrimaryKey();
    }
}
