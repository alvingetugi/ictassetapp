<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%transaction}}".
 *
 * @property int $id
 * @property string $code
 * @property string $date
 * @property int $transaction_type
 * @property string $staff
 * @property int $location_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Location $location
 * @property TransactionDetail[] $transactionDetails
 * @property TransactionType $transactionType
 * @property User $updatedBy
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transaction}}';
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
            [['code', 'date', 'transaction_type', 'staff', 'location_id'], 'required'],
            [['date'], 'safe'],
            [['transaction_type', 'location_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['staff'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['transaction_type'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionType::class, 'targetAttribute' => ['transaction_type' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
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
            'date' => 'Date',
            'transaction_type' => 'Transaction Type',
            'staff' => 'Staff',
            'location_id' => 'Location ID',
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
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\LocationQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::class, ['id' => 'location_id']);
    }

    /**
     * Gets query for [[TransactionDetails]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionDetailQuery
     */
    public function getTransactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, ['trans_id' => 'id']);
    }

    /**
     * Gets query for [[TransactionType]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionTypeQuery
     */
    public function getTransactionType()
    {
        return $this->hasOne(TransactionType::class, ['id' => 'transaction_type']);
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
     * @return \common\models\query\TransactionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TransactionQuery(get_called_class());
    }
}
