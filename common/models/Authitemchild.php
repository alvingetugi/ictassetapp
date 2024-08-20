<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auth_item_child".
 *
 * @property string $parent
 * @property string $child
 *
 * @property AuthItem $child0
 * @property AuthItem $parent0
 */
class Authitemchild extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item_child';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['child', 'parent'], 'unique', 'targetAttribute' => ['child', 'parent']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::class, 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::class, 'targetAttribute' => ['child' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent' => 'Parent',
            'child' => 'Child',
        ];
    }

    /**
     * Gets query for [[Child0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AuthItemQuery
     */
    public function getChild0()
    {
        return $this->hasOne(AuthItem::class, ['name' => 'child']);
    }

    /**
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AuthItemQuery
     */
    public function getParent0()
    {
        return $this->hasOne(AuthItem::class, ['name' => 'parent']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AuthitemchildQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AuthitemchildQuery(get_called_class());
    }
}
