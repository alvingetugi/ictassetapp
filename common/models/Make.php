<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%makes}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property string $category_id
 */
class Make extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%makes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'category_id'], 'required'],
            [['description'], 'string'],
            [['code', 'category_id'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MakeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MakeQuery(get_called_class());
    }

    public static function getMakesList($cat_id)
    {
        $Makes = self::find()
        ->select(['id', 'name'])
        ->where(['category_id' => $cat_id])//fetches makes based on category code from Categories
        ->asArray()
        ->all();

        return $Makes;
    }

}
