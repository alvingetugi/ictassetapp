<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accessorylist".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $tag_number
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
            [['code', 'tag_number'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['tag_number'], 'unique'],
            [['name'], 'unique'],
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
            'tag_number' => 'Tag or serial',
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
}
