<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_type".
 *
 * @property string $id
 * @property string $name_vi
 * @property string $name_en
 * @property integer $is_parent
 * @property string $parent_id
 */
class PostType extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_vi', 'name_en'], 'required'],
            [['is_parent', 'parent_id'], 'integer'],
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
            'is_parent' => Yii::t('app', 'Is Parent'),
            'parent_id' => Yii::t('app', 'Parent ID'),
        ];
    }
}
