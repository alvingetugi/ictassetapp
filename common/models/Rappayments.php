<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rappayments".
 *
 * @property int $id
 * @property int $rapID
 * @property string $date
 * @property float $amount
 * @property string $comments
 * @property string $proof
 *
 * @property Rap $rap
 */
class Rappayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rappayments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rapID', 'date', 'amount', 'comments', 'proof'], 'required'],
            [['rapID'], 'integer'],
            [['date'], 'safe'],
            [['amount'], 'number'],
            [['comments'], 'string', 'max' => 50],
            [['proof'], 'string', 'max' => 2000],
            [['rapID'], 'exist', 'skipOnError' => true, 'targetClass' => Rap::class, 'targetAttribute' => ['rapID' => 'id']],
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
            'date' => 'Date',
            'amount' => 'Amount',
            'comments' => 'Comments',
            'proof' => 'Proof',
        ];
    }

    /**
     * Gets query for [[Rap]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRap()
    {
        return $this->hasOne(Rap::class, ['id' => 'rapID']);
    }
}
