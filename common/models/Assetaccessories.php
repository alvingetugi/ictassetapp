<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assetaccessories".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property int $assetID
 *
 * @property Ictassets $asset
 */
class Assetaccessories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assetaccessories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['assetID'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name', 'description'], 'string', 'max' => 255],
            [['assetID'], 'exist', 'skipOnError' => true, 'targetClass' => Ictassets::class, 'targetAttribute' => ['assetID' => 'id']],
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
            'assetID' => 'Asset ID',
        ];
    }

    /**
     * Gets query for [[Asset]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsset()
    {
        return $this->hasOne(Ictassets::class, ['id' => 'assetID']);
    }
}
