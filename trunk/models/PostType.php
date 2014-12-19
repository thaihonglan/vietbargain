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
    private static $_data = null;

    private $_children = [];

    public function setChildren($values)
    {
        $this->_children = $values;
    }

    public function getChildren()
    {
        return $this->_children;
    }

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
            'name_vi' => Yii::t('admin', 'Vietnamese Name'),
            'name_en' => Yii::t('admin', 'English Name'),
            'is_parent' => Yii::t('admin', 'Is Parent'),
            'parent_id' => Yii::t('admin', 'Parent ID'),
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['name_vi', 'name_en'],
            'update' => ['name_vi', 'name_en'],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->parent_id != 0) {
            $parent = self::findOne(['id' => $this->parent_id]);

            if ($parent->is_parent == 0) {
                if ($insert || self::find()->where(['is_parent' => $parent->id])->exists()) {
                    $connection = \Yii::$app->db;
                    $connection->createCommand()->update(self::tableName(), ['is_parent' => 1], ['id' => $parent->id])->execute();
                }
            }
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        if ($this->parent_id != 0) {
            if (!self::find()->where(['is_parent' => $this->parent_id])->exists()) {
                $connection = \Yii::$app->db;
                $connection->createCommand()->update(self::tableName(), ['is_parent' => 0], ['id' => $this->parent_id])->execute();
            }
        }
    }

    public function getName()
    {
        return $this->{'name_' . self::getLang()};
    }

    public static function findFull()
    {
        if (self::$_data === null) {
            self::$_data = self::find()->all();
        }

        return self::$_data;
    }

    public static function findAllAsFiliation($currentId = 0)
    {
        $items = self::findFull();
        $options = self::_loopFiliation($items, $currentId);

        return $options;
    }

    private static function _loopFiliation(&$items, $currentId)
    {
        $return = [];
        foreach ($items as $item) {
            if ($item->parent_id == $currentId) {
                if ($item->is_parent) {
                    $item->children = self::_loopFiliation($items, $item->id);
                }
                $return[] = $item;
            }
        }
        return $return;
    }
}
