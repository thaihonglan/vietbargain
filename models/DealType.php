<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deal_type".
 *
 * @property string $id
 * @property string $name_vi
 * @property string $name_en
 */
class DealType extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deal_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_vi', 'name_en'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_vi' => Yii::t('app', 'Name Vi'),
            'name_en' => Yii::t('app', 'Name En'),
        ];
    }
}
