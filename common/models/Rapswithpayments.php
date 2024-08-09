<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rapswithpayments".
 *
 * @property int $rapID
 * @property int $schemeID
 * @property string $rapREF
 * @property string $raptype
 * @property string $rapstatus
 * @property float $deficit
 * @property string $startdate
 * @property string $enddate
 * @property float|null $totalcommitments
 * @property float|null $totalpayments
 */
class Rapswithpayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rapswithpayments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rapID', 'schemeID', 'rapREF', 'raptype', 'rapstatus', 'deficit', 'startdate', 'enddate'], 'required'],
            [['rapID', 'schemeID'], 'integer'],
            [['deficit', 'totalcommitments', 'totalpayments'], 'number'],
            [['startdate', 'enddate'], 'safe'],
            [['rapREF', 'raptype'], 'string', 'max' => 255],
            [['rapstatus'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rapID' => 'Rap ID',
            'schemeID' => 'Scheme ID',
            'rapREF' => 'Rap Ref',
            'raptype' => 'Raptype',
            'rapstatus' => 'Rapstatus',
            'deficit' => 'Deficit',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'totalcommitments' => 'Totalcommitments',
            'totalpayments' => 'Totalpayments',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RapswithpaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RapswithpaymentsQuery(get_called_class());
    }
}
