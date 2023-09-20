<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%depreciation}}".
 *
 * @property int $id
 * @property int $equipment_id
 * @property float $purchase_value
 * @property float $current_value
 * @property int|null $created_at
 * @property int|null $created_by
 *
 * @property Equipment $equipment
 */
class Depreciation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%depreciation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipment_id', 'purchase_value', 'current_value'], 'required'],
            [['equipment_id', 'created_at', 'created_by'], 'integer'],
            [['purchase_value', 'current_value'], 'number'],
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::class, 'targetAttribute' => ['equipment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipment_id' => 'Equipment ID',
            'purchase_value' => 'Purchase Value',
            'current_value' => 'Current Value',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Equipment]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EquipmentQuery
     */
    public function getEquipment()
    {
        return $this->hasOne(Equipment::class, ['id' => 'equipment_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DepreciationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DepreciationQuery(get_called_class());
    }
}
