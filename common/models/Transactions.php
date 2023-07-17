<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%transactions}}".
 *
 * @property int $id
 * @property string $code
 * @property int $date
 * @property string $transaction_type
 * @property string $location
 * @property string|null $details
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Locations $location0
 * @property TransactionDetails[] $transactionDetails
 * @property TransactionTypes $transactionType
 * @property User $updatedBy
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transactions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'transaction_type', 'location'], 'required'],
            [['date', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['details'], 'string'],
            [['code', 'transaction_type', 'location'], 'string', 'max' => 50],
            [['code'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['transaction_type'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionTypes::class, 'targetAttribute' => ['transaction_type' => 'code']],
            [['location'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::class, 'targetAttribute' => ['location' => 'code']],
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
            'date' => 'Date',
            'transaction_type' => 'Transaction Type',
            'location' => 'Location',
            'details' => 'Details',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
     * Gets query for [[Location0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\LocationsQuery
     */
    public function getLocation0()
    {
        return $this->hasOne(Locations::class, ['code' => 'location']);
    }

    /**
     * Gets query for [[TransactionDetails]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionDetailsQuery
     */
    public function getTransactionDetails()
    {
        return $this->hasMany(TransactionDetails::class, ['trans_id' => 'id']);
    }

    /**
     * Gets query for [[TransactionType]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionTypesQuery
     */
    public function getTransactionType()
    {
        return $this->hasOne(TransactionTypes::class, ['code' => 'transaction_type']);
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
     * @return \common\models\query\TransactionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TransactionsQuery(get_called_class());
    }
}
