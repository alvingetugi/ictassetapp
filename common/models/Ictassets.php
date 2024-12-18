<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ictassets".
 *
 * @property int $id
 * @property string $code
 * @property int $categoryID
 * @property int $makeID
 * @property int $modelID
 * @property string $name
 * @property string $tag_number
 * @property int $storageID
 * @property int $ramID
 * @property int $osID
 * @property int $locationID
 * @property int $assetstatus
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
 * @property Locations $location
 * @property Assetmakes $make
 * @property Assetmodels $model
 * @property Operatingsystem $os
 * @property Ram $ram
 * @property Storage $storage
 * @property User $updatedBy
 */
class Ictassets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ictassets';
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
            [['categoryID', 'makeID', 'modelID', 'name', 'tag_number', 'storageID', 'ramID', 'osID', 'locationID', 'assetcondition'], 'required'],
            [['categoryID', 'makeID', 'modelID', 'storageID', 'ramID', 'osID', 'locationID', 'assetstatus', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code', 'name', 'tag_number', 'assetcondition'], 'string', 'max' => 50],
            [['tag_number'], 'unique'],
            [['name'], 'unique'],
            [['code'], 'unique'],
            [['osID'], 'exist', 'skipOnError' => true, 'targetClass' => Operatingsystem::class, 'targetAttribute' => ['osID' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['categoryID'], 'exist', 'skipOnError' => true, 'targetClass' => Assetcategories::class, 'targetAttribute' => ['categoryID' => 'id']],
            [['makeID'], 'exist', 'skipOnError' => true, 'targetClass' => Assetmakes::class, 'targetAttribute' => ['makeID' => 'id']],
            [['modelID'], 'exist', 'skipOnError' => true, 'targetClass' => Assetmodels::class, 'targetAttribute' => ['modelID' => 'id']],
            [['locationID'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::class, 'targetAttribute' => ['locationID' => 'id']],
            [['storageID'], 'exist', 'skipOnError' => true, 'targetClass' => Storage::class, 'targetAttribute' => ['storageID' => 'id']],
            [['ramID'], 'exist', 'skipOnError' => true, 'targetClass' => Ram::class, 'targetAttribute' => ['ramID' => 'id']],
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
            'name' => 'Serial Number',
            'tag_number' => 'Tag Number',
            'storageID' => 'Storage',
            'ramID' => 'RAM',
            'osID' => 'Operating System',
            'locationID' => 'Location',
            'assetstatus' => 'Status',
            'assetcondition' => 'Condition',
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
     * Gets query for [[Os]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OperatingsystemQuery
     */
    public function getOs()
    {
        return $this->hasOne(Operatingsystem::class, ['id' => 'osID']);
    }

    /**
     * Gets query for [[Ram]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RamQuery
     */
    public function getRam()
    {
        return $this->hasOne(Ram::class, ['id' => 'ramID']);
    }

    /**
     * Gets query for [[Storage]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\StorageQuery
     */
    public function getStorage()
    {
        return $this->hasOne(Storage::class, ['id' => 'storageID']);
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

    //Fetches all assets that can be issued by their Serial Numbers
    public static function getSerialsList($cat_id, $model_id, $isAjax = false)
    {
        $model = self::find()
            ->where(['categoryID' => $cat_id])
            ->andWhere(['modelID' => $model_id])
            ->andWhere(['assetstatus' => [1,3]]);

        if ($isAjax) {
            return $model->select(['id', 'name'])->asArray()->all();
        } else {
            return $model->select(['name'])->indexBy('id')->column();
        }
    }

    //Fetches all assets that have been issued for surrender purposes
    public static function getIssuedAssets($cat_id, $model_id, $isAjax = false)
    {
        $model = self::find()
            ->where(['categoryID' => $cat_id])
            ->andWhere(['modelID' => $model_id])
            ->andWhere(['assetstatus' => 2]);

        if ($isAjax) {
            return $model->select(['id', 'name'])->asArray()->all();
        } else {
            return $model->select(['name'])->indexBy('id')->column();
        }
    }

    //Fetches all accessories attached to their relevant assets
    public static function getAccessoryList($cat_id, $model_id, $serialnumber, $isAjax = false)
    {
        // Example query to get accessories based on category, model, and serial number
        $model = Accessorylist::find()
            ->innerJoin('assetaccessories', 'assetaccessories.accessorylistID = accessorylist.id')
            ->innerJoin('ictassets', 'assetaccessories.assetID = ictassets.id')
            ->where([
                'ictassets.categoryID' => $cat_id,
                'ictassets.modelID' => $model_id,
                'ictassets.id' => $serialnumber,
            ]);
        // If it's an Ajax request, return as an array with 'id' and 'name' fields
        if ($isAjax) {
            return $model->select(['accessorylist.id', 'accessorylist.name']) // Explicitly use the table alias
                ->asArray()
                ->all();
        } else {
            // If it's not an Ajax request, return the 'name' indexed by 'id'
            return $model->select(['accessorylist.name']) // Explicitly use the table alias
                ->indexBy('accessorylist.id') // Use 'accessorylist.id' to index
                ->column();
        }
    }
}
