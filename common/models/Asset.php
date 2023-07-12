<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%assets}}".
 *
 * @property int $id
 * @property string $code
 * @property string $category
 * @property string $make
 * @property string $model
 * @property string $name
 * @property string $serial_number
 * @property string $tag_number
 * @property string|null $details
 * @property int $date_of_delivery
 * @property string $location
 * @property int $status
 * @property int $condition
 *
 * @property TransactionDetails[] $transactionDetails
 */
class Asset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%assets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'category', 'make', 'model', 'name', 'serial_number', 'tag_number', 'location', 'status', 'condition'], 'required'],
            [['details'], 'string'],
            [['date_of_delivery', 'status', 'condition'], 'integer'],
            [['code', 'category', 'make', 'model', 'serial_number', 'tag_number'], 'string', 'max' => 50],
            [['name', 'location'], 'string', 'max' => 255],
            [['tag_number'], 'unique'],
            [['serial_number'], 'unique'],
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
            'category' => 'Category',
            'make' => 'Make',
            'model' => 'Model',
            'name' => 'Name',
            'serial_number' => 'Serial Number',
            'tag_number' => 'Tag Number',
            'details' => 'Details',
            'date_of_delivery' => 'Date Of Delivery',
            'location' => 'Location',
            'status' => 'Status',
            'condition' => 'Condition',
        ];
    }

    /**
     * Gets query for [[TransactionDetails]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionDetailsQuery
     */
    public function getTransactionDetails()
    {
        return $this->hasMany(TransactionDetails::class, ['asset_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AssetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AssetQuery(get_called_class());
    }
}
