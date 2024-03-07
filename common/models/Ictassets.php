<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%ictassets}}".
 *
 * @property int $id
 * @property string $code
 * @property int $categoryID
 * @property int $makeID
 * @property int $modelID
 * @property string $name
 * @property string $tag_number
 * @property int $storage
 * @property int $ram
 * @property string $operating_system
 * @property string $date_of_delivery
 * @property int $locationID
 * @property string $assetstatus
 * @property string $assetcondition
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Assetaccessories[] $assetaccessories
 * @property Assetcategories $category
 * @property User $createdBy
 * @property Depreciation[] $depreciations
 * @property Issuances[] $issuances
 * @property Locations $location
 * @property Assetmakes $make
 * @property Assetmodels $model
 * @property User $updatedBy
 */
class Ictassets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ictassets}}';
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
            [['categoryID', 'makeID', 'modelID', 'name','storage', 'ram', 'operating_system', 'date_of_delivery', 'locationID', 'assetcondition'], 'required'],
            [['categoryID', 'makeID', 'modelID', 'storage', 'ram', 'locationID', 'created_at', 'updated_at', 'created_by', 'updated_by','assetstatus'], 'integer'],
            [['date_of_delivery'], 'safe'],
            [['code', 'name', 'tag_number', 'operating_system',  'assetcondition'], 'string', 'max' => 50],
            [['tag_number'], 'unique'],
            [['name'], 'unique'],
            [['code'], 'unique'],
            [['categoryID'], 'exist', 'skipOnError' => true, 'targetClass' => Assetcategories::class, 'targetAttribute' => ['categoryID' => 'id']],
            [['makeID'], 'exist', 'skipOnError' => true, 'targetClass' => Assetmakes::class, 'targetAttribute' => ['makeID' => 'id']],
            [['modelID'], 'exist', 'skipOnError' => true, 'targetClass' => Assetmodels::class, 'targetAttribute' => ['modelID' => 'id']],
            [['locationID'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::class, 'targetAttribute' => ['locationID' => 'id']],
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
            'code' => 'Code',
            'categoryID' => 'Category',
            'makeID' => 'Make',
            'modelID' => 'Model',
            'name' => 'Serial number',
            'tag_number' => 'Tag Number',
            'storage' => 'Storage',
            'ram' => 'Ram',
            'operating_system' => 'Operating System',
            'date_of_delivery' => 'Date Of Delivery',
            'locationID' => 'Location',
            'assetstatus' => 'Asset Status',
            'assetcondition' => 'Asset Condition',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Assetaccessories]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetaccessoriesQuery
     */
    public function getAssetaccessories()
    {
        return $this->hasMany(Assetaccessories::class, ['assetID' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetcategoriesQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Assetcategories::class, ['id' => 'categoryID']);
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
     * Gets query for [[Depreciations]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\DepreciationQuery
     */
    public function getDepreciations()
    {
        return $this->hasMany(Depreciation::class, ['assetID' => 'id']);
    }

    /**
     * Gets query for [[Issuances]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\IssuancesQuery
     */
    public function getIssuances()
    {
        return $this->hasMany(Issuances::class, ['assetID' => 'id']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\LocationsQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::class, ['id' => 'locationID']);
    }

    public function getAssetStatus()
    {
        return $this->hasOne(Assetstatus::class, ['id' => 'assetstatus']);
    }

    /**
     * Gets query for [[Make]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetmakesQuery
     */
    public function getMake()
    {
        return $this->hasOne(Assetmakes::class, ['id' => 'makeID']);
    }

    /**
     * Gets query for [[Model]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetmodelsQuery
     */
    public function getModel()
    {
        return $this->hasOne(Assetmodels::class, ['id' => 'modelID']);
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
     * @return \common\models\query\IctassetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\IctassetsQuery(get_called_class());
    }

    public static function getSerialsList($cat_id, $model_id, $isAjax = false)
    {
        $model = self::find()
            ->where(['categoryID' => $cat_id])
            ->andWhere(['modelID' => $model_id])
            ->andWhere(['assetstatus' => [2,3,4]]);

        if ($isAjax) {
            return $model->select(['id', 'name'])->asArray()->all();
        } else {
            return $model->select(['name'])->indexBy('id')->column();
        }
    }

    public static function getIssuedAssets($cat_id, $model_id, $isAjax = false)
    {
        $model = self::find()
            ->where(['categoryID' => $cat_id])
            ->andWhere(['modelID' => $model_id])
            ->andWhere(['assetstatus' => 1]);

        if ($isAjax) {
            return $model->select(['id', 'name'])->asArray()->all();
        } else {
            return $model->select(['name'])->indexBy('id')->column();
        }
    }
}
