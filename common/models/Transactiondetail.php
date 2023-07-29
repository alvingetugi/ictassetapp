<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%transaction_detail}}".
 *
 * @property int $id
 * @property int $trans_id
 * @property int $equipment_id
 * @property string|null $details
 *
 * @property Transaction $trans
 */
class Transactiondetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transaction_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipment_id'], 'required'],
            [['trans_id', 'equipment_id'], 'integer'],
            [['details'], 'string'],
            [['trans_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::class, 'targetAttribute' => ['trans_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_id' => 'Trans ID',
            'equipment_id' => 'Equipment ID',
            'details' => 'Details',
        ];
    }

    /**
     * Gets query for [[Trans]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionQuery
     */
    public function getTrans()
    {
        return $this->hasOne(Transaction::class, ['id' => 'trans_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TransactiondetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TransactiondetailQuery(get_called_class());
    }
}
