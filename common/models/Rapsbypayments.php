<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rapsbypayments".
 *
 * @property int|null $rapID
 * @property int|null $schemeID
 * @property string|null $rapref
 * @property string|null $raptype
 * @property string|null $rapstatus
 * @property float|null $deficit
 * @property string|null $startdate
 * @property string|null $enddate
 * @property float|null $expectedamount
 * @property float|null $totalpayments
 */
class Rapsbypayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rapsbypayments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rapID', 'schemeID'], 'integer'],
            [['deficit', 'expectedamount', 'totalpayments'], 'number'],
            [['startdate', 'enddate'], 'safe'],
            [['rapref', 'raptype'], 'string', 'max' => 255],
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
            'rapref' => 'Rapref',
            'raptype' => 'Raptype',
            'rapstatus' => 'Rapstatus',
            'deficit' => 'Deficit',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'expectedamount' => 'Expectedamount',
            'totalpayments' => 'Totalpayments',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RapsbypaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RapsbypaymentsQuery(get_called_class());
    }
}
