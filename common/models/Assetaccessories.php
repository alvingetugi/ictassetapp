<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assetaccessories".
 *
 * @property int $id
 * @property int|null $accessorylistID
 * @property int|null $assetID
 *
 * @property Accessorylist $accessorylist
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
            [['accessorylistID', 'assetID'], 'integer'],
            [['accessorylistID'], 'exist', 'skipOnError' => true, 'targetClass' => Accessorylist::class, 'targetAttribute' => ['accessorylistID' => 'id']],
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
            'accessorylistID' => 'Accessorylist ID',
            'assetID' => 'Asset ID',
        ];
    }

    /**
     * Gets query for [[Accessorylist]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AccessorylistQuery
     */
    public function getAccessorylist()
    {
        return $this->hasOne(Accessorylist::class, ['id' => 'accessorylistID']);
    }

    /**
     * Gets query for [[Asset]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\IctassetsQuery
     */
    public function getAsset()
    {
        return $this->hasOne(Ictassets::class, ['id' => 'assetID']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AssetaccessoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AssetaccessoriesQuery(get_called_class());
    }
}
