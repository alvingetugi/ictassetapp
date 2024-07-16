<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "remedialactionplans".
 *
 * @property int $id
 * @property string $rapref
 * @property int $schemeID
 * @property string|null $raptype
 * @property int $deficit
 * @property string $planstart
 * @property string $frequency
 * @property int $installmentamount
 * @property string $planend
 * @property string $comments
 * @property int $runningbalance
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Planledger[] $planledgers
 * @property User $updatedBy
 */
class Remedialactionplans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'remedialactionplans';
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
            [['schemeID', 'deficit', 'planstart', 'frequency', 'installmentamount', 'planend', 'comments', 'runningbalance'], 'required'],
            [['schemeID', 'deficit', 'installmentamount', 'runningbalance', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['planstart', 'planend'], 'safe'],
            [['rapref', 'raptype', 'frequency', 'comments'], 'string', 'max' => 255],
            [['rapref'], 'unique'],
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
            'rapref' => 'Plan ID',
            'schemeID' => 'Scheme',
            'raptype' => 'Plan Type',
            'deficit' => 'Deficit',
            'planstart' => 'Plan Start',
            'frequency' => 'Frequency',
            'installmentamount' => 'Installment Amount',
            'planend' => 'Plan End',
            'comments' => 'Comments',
            'runningbalance' => 'Running Balance',
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
     * Gets query for [[Planledgers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanledgers()
    {
        return $this->hasMany(Planledger::class, ['rapID' => 'id']);
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

    public function getSchemes()
    {
        return $this->hasOne(Schemes::class, ['ref' => 'schemeID']);
    }

    public function getFrequencies()
    {
        return $this->hasOne(Frequency::class, ['ref' => 'frequency']);
    }
}
