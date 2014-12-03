<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property string $content
 * @property string $user_id
 * @property string $post_id
 * @property string $parent_id
 * @property string $create_datetime
 * @property integer $is_approved
 */
class Comment extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['user_id', 'post_id', 'parent_id', 'is_approved'], 'integer'],
            [['create_datetime'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'content' => Yii::t('admin', 'Content'),
            'user_id' => Yii::t('admin', 'User ID'),
            'post_id' => Yii::t('admin', 'Post ID'),
            'parent_id' => Yii::t('admin', 'Parent ID'),
            'create_datetime' => Yii::t('admin', 'Create Datetime'),
            'is_approved' => Yii::t('admin', 'Is Approved'),
        ];
    }
}
