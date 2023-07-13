<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%models}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property string $category_id
 * @property string $make_id
 */
class Models extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%models}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'category_id', 'make_id'], 'required'],
            [['description'], 'string'],
            [['code', 'category_id', 'make_id'], 'string', 'max' => 50],
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
            'make_id' => 'Make ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ModelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ModelsQuery(get_called_class());
    }

    //Gets model list for the create function
    public static function getModelsList($cat_id, $make_id)
    {
        $Models = self::find() 
        ->select(['id', 'name'])
        ->where([
            'category_id' => $cat_id,
            ])
        ->asArray()
        ->all();

        return $Models;
    }

    //Gets model list for the update function
    public static function getModels($cat_id, $make_id){
        return self::find()
        ->select(['name', 'id'])
        ->where(['category_id' => $cat_id])
        ->indexBy('id')
        ->column();
    }
}
