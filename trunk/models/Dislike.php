<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dislike".
 *
 * @property string $post_id
 * @property string $user_id
 * @property string $comment_id
 */
class Dislike extends \app\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dislike';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id', 'comment_id'], 'required'],
            [['post_id', 'user_id', 'comment_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'comment_id' => Yii::t('app', 'Comment ID'),
        ];
    }
}
