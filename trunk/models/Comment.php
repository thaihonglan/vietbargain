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
            'id' => Yii::t('app', 'ID'),
            'content' => Yii::t('app', 'Content'),
            'user_id' => Yii::t('app', 'User ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'create_datetime' => Yii::t('app', 'Create Datetime'),
            'is_approved' => Yii::t('app', 'Is Approved'),
        ];
    }
}
