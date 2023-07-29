<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%location}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property Equipment[] $equipments
 * @property Transaction[] $transactions
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%location}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Equipments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EquipmentQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::class, ['location_id' => 'id']);
    }

    /**
     * Gets query for [[Transactions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::class, ['location_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\LocationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LocationQuery(get_called_class());
    }
}
