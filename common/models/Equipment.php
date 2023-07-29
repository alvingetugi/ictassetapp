<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%equipment}}".
 *
 * @property int $id
 * @property string $code
 * @property int $category_id
 * @property int $make_id
 * @property int $equipmodel_id
 * @property string $name
 * @property string $serial_number
 * @property string $tag_number
 * @property string|null $details
 * @property string $date_of_delivery
 * @property int $location_id
 * @property int $status
 * @property int $condition
 *
 * @property Category $category
 * @property Equipmentmodel $equipmodel
 * @property Location $location
 * @property Make $make
 * @property TransactionDetail[] $transactionDetails
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%equipment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'category_id', 'make_id', 'equipmodel_id', 'name', 'serial_number', 'tag_number', 'date_of_delivery', 'location_id', 'status', 'condition'], 'required'],
            [['category_id', 'make_id', 'equipmodel_id', 'location_id', 'status', 'condition'], 'integer'],
            [['details'], 'string'],
            [['date_of_delivery'], 'safe'],
            [['code', 'serial_number', 'tag_number'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['tag_number'], 'unique'],
            [['serial_number'], 'unique'],
            [['code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['make_id'], 'exist', 'skipOnError' => true, 'targetClass' => Make::class, 'targetAttribute' => ['make_id' => 'id']],
            [['equipmodel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipmentmodel::class, 'targetAttribute' => ['equipmodel_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
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
            'category_id' => 'Category',
            'make_id' => 'Make',
            'equipmodel_id' => 'Model',
            'name' => 'Name',
            'serial_number' => 'Serial Number',
            'tag_number' => 'Tag Number',
            'details' => 'Details',
            'date_of_delivery' => 'Date Of Delivery',
            'location_id' => 'Location',
            'status' => 'Active',
            'condition' => 'Good to issue',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Equipmodel]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EquipmentmodelQuery
     */
    public function getEquipmodel()
    {
        return $this->hasOne(Equipmentmodel::class, ['id' => 'equipmodel_id']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\LocationQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::class, ['id' => 'location_id']);
    }

    /**
     * Gets query for [[Make]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MakeQuery
     */
    public function getMake()
    {
        return $this->hasOne(Make::class, ['id' => 'make_id']);
    }

    /**
     * Gets query for [[TransactionDetails]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionDetailQuery
     */
    public function getTransactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, ['equipment_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\EquipmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\EquipmentQuery(get_called_class());
    }
}
