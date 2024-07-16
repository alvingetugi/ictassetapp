<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "planledger".
 *
 * @property int $id
 * @property int|null $rapID
 * @property int|null $debit
 * @property int|null $credit
 * @property int|null $runningbalance
 * @property string|null $status
 * @property string|null $duedate
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Remedialactionplans $rap
 */
class Planledger extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'planledger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rapID', 'debit', 'credit', 'runningbalance', 'created_at', 'updated_at'], 'integer'],
            [['duedate'], 'safe'],
            [['status'], 'string', 'max' => 255],
            [['rapID'], 'exist', 'skipOnError' => true, 'targetClass' => Remedialactionplans::class, 'targetAttribute' => ['rapID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rapID' => 'Rap ID',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'runningbalance' => 'Runningbalance',
            'status' => 'Status',
            'duedate' => 'Duedate',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Rap]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRap()
    {
        return $this->hasOne(Remedialactionplans::class, ['id' => 'rapID']);
    }
}
