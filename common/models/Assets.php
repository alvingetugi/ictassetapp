<?php

namespace common\models;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "{{%assets}}".
 *
 * @property int $id
 * @property string $model
 * @property int $asset_master_id
 * @property int $location_id
 * @property string $serial_number
 * @property string $tag_number
 * @property int $storage
 * @property int $ram
 * @property string|null $accessories
 * @property string $condition
 * @property string $location
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AssetsMaster $assetMaster
 * @property User $createdBy
 * @property Issuances[] $issuances
 * @property Locations $location0
 * @property User $updatedBy
 */
class Assets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%assets}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model', 'asset_master_id', 'location_id', 'serial_number', 'tag_number', 'storage', 'ram', 'condition', 'location', 'status'], 'required'],
            [['asset_master_id', 'location_id', 'storage', 'ram', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['model', 'serial_number', 'tag_number', 'accessories', 'condition', 'location'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::class, 'targetAttribute' => ['location_id' => 'id']],
            [['asset_master_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssetsMaster::class, 'targetAttribute' => ['asset_master_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Model',
            'asset_master_id' => 'Asset Master ID',
            'location_id' => 'Location ID',
            'serial_number' => 'Serial Number',
            'tag_number' => 'Tag Number',
            'storage' => 'Storage',
            'ram' => 'Ram',
            'accessories' => 'Accessories',
            'condition' => 'Condition',
            'location' => 'Location',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[AssetMaster]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetsMasterQuery
     */
    public function getAssetMaster()
    {
        return $this->hasOne(AssetsMaster::class, ['id' => 'asset_master_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Issuances]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\IssuancesQuery
     */
    public function getIssuances()
    {
        return $this->hasMany(Issuances::class, ['asset_id' => 'id']);
    }

    /**
     * Gets query for [[Location0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\LocationsQuery
     */
    public function getLocation0()
    {
        return $this->hasOne(Locations::class, ['id' => 'location_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AssetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AssetsQuery(get_called_class());
    }
}
