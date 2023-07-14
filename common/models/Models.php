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
            'category_id' => 'Category',
            'make_id' => 'Make',
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

       public static function getModelsList($cat_id, $make_id, $isAjax = false)
{
    $model = self::find()
        ->where(['category_id' => $cat_id])
        ->andWhere(['make_id' => $make_id]);

    if ($isAjax) {
        return $model->select(['id', 'name'])->asArray()->all();
    } else {
        return $model->select(['name'])->indexBy('id')->column();
    }
}
}
