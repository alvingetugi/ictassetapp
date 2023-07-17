<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%transaction_types}}".
 *
 * @property int $id
 * @property string $code
 * @property string $type
 *
 * @property Transactions[] $transactions
 */
class Transactiontypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transaction_types}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'type'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 255],
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
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[Transactions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionsQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::class, ['transaction_type' => 'code']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TransactiontypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TransactiontypesQuery(get_called_class());
    }
}
