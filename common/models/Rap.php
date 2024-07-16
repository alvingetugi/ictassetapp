<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "rap".
 *
 * @property int $id
 * @property int $typeID
 * @property int $schemeID
 * @property int $status
 * @property float $amount
 * @property string $start
 * @property string $end
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Rapcommitments[] $rapcommitments
 * @property Rappayments[] $rappayments
 * @property Schemes $scheme
 * @property Raptypes $type
 * @property User $updatedBy
 */
class Rap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rap';
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
            [['typeID', 'schemeID', 'status', 'amount', 'start', 'end'], 'required'],
            [['typeID', 'schemeID', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['amount'], 'number'],
            [['start', 'end'], 'safe'],
            [['typeID'], 'exist', 'skipOnError' => true, 'targetClass' => Raptypes::class, 'targetAttribute' => ['typeID' => 'id']],
            [['schemeID'], 'exist', 'skipOnError' => true, 'targetClass' => Schemes::class, 'targetAttribute' => ['schemeID' => 'id']],
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
            'typeID' => 'Type',
            'schemeID' => 'Scheme',
            'status' => 'Status',
            'amount' => 'Amount',
            'start' => 'Start',
            'end' => 'End',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Rapcommitments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRapcommitments()
    {
        return $this->hasMany(Rapcommitments::class, ['rapID' => 'id']);
    }

    /**
     * Gets query for [[Rappayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRappayments()
    {
        return $this->hasMany(Rappayments::class, ['rapID' => 'id']);
    }

    /**
     * Gets query for [[Scheme]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScheme()
    {
        return $this->hasOne(Schemes::class, ['id' => 'schemeID']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Raptypes::class, ['id' => 'typeID']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
