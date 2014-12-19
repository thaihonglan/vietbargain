<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $user_id
 * @property string $contact_number
 * @property string $store_address
 * @property string $link
 * @property string $discount_code
 * @property integer $is_owner
 * @property string $image
 * @property integer $deal_type
 * @property string $deal_begin_date
 * @property string $deal_end_date
 * @property string $status
 */
class Post extends \app\components\ActiveRecord
{
    const STATUS_UNAPPROVED = 0;
    const STATUS_APPROVED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['user_id', 'is_owner', 'deal_type', 'status'], 'integer'],
            [['deal_begin_date', 'deal_end_date'], 'safe'],
            [['title', 'contact_number', 'discount_code'], 'string', 'max' => 32],
            [['store_address'], 'string', 'max' => 128],
            [['link', 'image'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'title' => Yii::t('admin', 'Title'),
            'content' => Yii::t('admin', 'Content'),
            'user_id' => Yii::t('admin', 'User ID'),
            'contact_number' => Yii::t('admin', 'Contact Number'),
            'store_address' => Yii::t('admin', 'Store Address'),
            'link' => Yii::t('admin', 'Link'),
            'discount_code' => Yii::t('admin', 'Discount Code'),
            'is_owner' => Yii::t('admin', 'Is Owner'),
            'image' => Yii::t('admin', 'Image'),
            'deal_type' => Yii::t('admin', 'Deal Type'),
            'deal_begin_date' => Yii::t('admin', 'Deal Begin Date'),
            'deal_end_date' => Yii::t('admin', 'Deal End Date'),
            'status' => Yii::t('admin', 'Status'),
        ];
    }

    public function getPostType()
    {
        return $this->hasMany(PostType::className(), ['id' => 'post_type_id'])->viaTable('post_type_allocation', ['post_id' => 'id']);
    }

    public function savePostType($postTypes)
    {
        if (!$this->id || empty($postTypes)) {
            return false;
        }

        if (!is_array($postTypes)) {
            $postTypes = [$postTypes];
        }

        $data = [];
        foreach ($postTypes as $type) {
            $data[] = [$this->id, $type];
        }

        $connection = \Yii::$app->db;
        return $connection->createCommand()->batchInsert('post_type_allocation', ['post_id', 'post_type_id'], $data)->execute();
    }
}
