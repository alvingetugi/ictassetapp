<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accessorylist".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $model_or_part_number
 *
 * @property Assetaccessories[] $assetaccessories
 */
class Accessorylist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accessorylist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['code', 'model_or_part_number'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            // [['model_or_part_number'], 'unique'],
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
            'tag_number' => 'Model or part number',
        ];
    }

    /**
     * Gets query for [[Assetaccessories]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetaccessoriesQuery
     */
    public function getAssetaccessories()
    {
        return $this->hasMany(Assetaccessories::class, ['accessorylistID' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AccessorylistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AccessorylistQuery(get_called_class());
    }

    public static function getAccessories()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
