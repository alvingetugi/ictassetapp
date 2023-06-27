<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%assets_master}}".
 *
 * @property int $id
 * @property string $category
 * @property string $brand
 * @property string $model
 * @property string $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Assets[] $assets
 * @property User $createdBy
 * @property User $updatedBy
 */
class Assetmaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%assets_master}}';
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
            [['category', 'brand', 'model', 'description'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['category', 'brand', 'model', 'description'], 'string', 'max' => 255],
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
            'category' => 'Category',
            'brand' => 'Brand',
            'model' => 'Model',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Assets]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetsQuery
     */
    public function getAssets()
    {
        return $this->hasMany(Assets::class, ['asset_master_id' => 'id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public static function getModels()
    {
        return self::find()->select(['model', 'id'])->indexBy('id')->column();
    }

    public static function getCatList($relmastasst_id)//gets all categories and puts them in an array
    {
        $Categories = self::find()
        ->select(['id', 'category as name'])
        ->where(['id' => $relmastasst_id])
        ->asArray()
        ->all();

        return $Categories;
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AssetmasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AssetmasterQuery(get_called_class());
    }
}
