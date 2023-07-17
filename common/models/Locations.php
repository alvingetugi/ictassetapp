<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%locations}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 *
 * @property Transactions[] $transactions
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%locations}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'description'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['name', 'description'], 'string', 'max' => 255],
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
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Transactions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionsQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::class, ['location' => 'code']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\LocationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LocationsQuery(get_called_class());
    }
}
