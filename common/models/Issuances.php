<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%issuances}}".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $department
 * @property int $asset_id
 * @property string $model
 * @property string $serial_number
 * @property string $tag_number
 * @property string $ram
 * @property string $storage
 * @property string $accessories
 * @property string $condition
 * @property int|null $created_at
 * @property int|null $created_by
 *
 * @property Assets $asset
 * @property User $createdBy
 * @property Surrenders[] $surrenders
 */
class Issuances extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%issuances}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'department', 'asset_id', 'model', 'serial_number', 'tag_number', 'ram', 'storage', 'accessories', 'condition'], 'required'],
            [['asset_id', 'created_at', 'created_by'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 45],
            [['department', 'model', 'serial_number', 'tag_number', 'ram', 'storage', 'accessories', 'condition'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['asset_id'], 'exist', 'skipOnError' => true, 'targetClass' => Assets::class, 'targetAttribute' => ['asset_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'department' => Yii::t('app', 'Department'),
            'asset_id' => Yii::t('app', 'Asset ID'),
            'model' => Yii::t('app', 'Model'),
            'serial_number' => Yii::t('app', 'Serial Number'),
            'tag_number' => Yii::t('app', 'Tag Number'),
            'ram' => Yii::t('app', 'Ram'),
            'storage' => Yii::t('app', 'Storage'),
            'accessories' => Yii::t('app', 'Accessories'),
            'condition' => Yii::t('app', 'Condition'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[Asset]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetsQuery
     */
    public function getAsset()
    {
        return $this->hasOne(Assets::class, ['id' => 'asset_id']);
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
     * Gets query for [[Surrenders]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SurrendersQuery
     */
    public function getSurrenders()
    {
        return $this->hasMany(Surrenders::class, ['issuance_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\IssuancesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\IssuancesQuery(get_called_class());
    }
}
