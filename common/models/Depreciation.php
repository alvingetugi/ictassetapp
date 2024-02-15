<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "depreciation".
 *
 * @property int $id
 * @property int $assetID
 * @property float $purchase_value
 * @property float $current_value
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Ictassets $asset
 * @property User $createdBy
 * @property User $updatedBy
 */
class Depreciation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'depreciation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assetID', 'purchase_value', 'current_value'], 'required'],
            [['assetID', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['purchase_value', 'current_value'], 'number'],
            [['assetID'], 'exist', 'skipOnError' => true, 'targetClass' => Ictassets::class, 'targetAttribute' => ['assetID' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'assetID' => 'Asset ID',
            'purchase_value' => 'Purchase Value',
            'current_value' => 'Current Value',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
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

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
