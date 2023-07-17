<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%transaction_details}}".
 *
 * @property int $id
 * @property int $trans_id
 * @property int $asset_id
 * @property string|null $details
 *
 * @property Assets $asset
 * @property Transactions $trans
 */
class Transactiondetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transaction_details}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_id', 'asset_id'], 'required'],
            [['trans_id', 'asset_id'], 'integer'],
            [['details'], 'string'],
            [['asset_id'], 'exist', 'skipOnError' => true, 'targetClass' => Assets::class, 'targetAttribute' => ['asset_id' => 'id']],
            [['trans_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transactions::class, 'targetAttribute' => ['trans_id' => 'id']],
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
            'asset_id' => 'Asset ID',
            'details' => 'Details',
        ];
    }

    /**
     * Gets query for [[Asset]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetsQuery
     */
    public function getAsset()
    {
        return $this->hasOne(Assets::class, ['id' => 'asset_id']);
    }

    /**
     * Gets query for [[Trans]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TransactionsQuery
     */
    public function getTrans()
    {
        return $this->hasOne(Transactions::class, ['id' => 'trans_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TransactiondetailsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TransactiondetailsQuery(get_called_class());
    }
}
