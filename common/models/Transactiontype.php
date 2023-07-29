<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%transaction_type}}".
 *
 * @property int $id
 * @property string $code
 * @property string $type
 *
 * @property Transaction[] $transactions
 */
class Transactiontype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transaction_type}}';
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
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::class, ['transaction_type' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TransactiontypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TransactiontypeQuery(get_called_class());
    }
}
