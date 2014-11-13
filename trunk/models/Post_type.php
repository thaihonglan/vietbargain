<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_type".
 *
 * @property string $id
 * @property string $name
 * @property string $column_name
 * @property integer $is_parent
 * @property string $parent_id
 */
class Post_type extends \app\components\ActiveRecord
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
            [['is_parent', 'parent_id'], 'integer'],
            [['name', 'column_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'column_name' => Yii::t('app', 'Column Name'),
            'is_parent' => Yii::t('app', 'Is Parent'),
            'parent_id' => Yii::t('app', 'Parent ID'),
        ];
    }
}
