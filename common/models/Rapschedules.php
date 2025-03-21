<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rapschedules".
 *
 * @property int $id
 * @property int $rapID
 * @property string $name
 * @property string $duedate
 * @property float $expectedamount
 * @property string $comments
 *
 * @property Rap $rap
 * @property Rappayments[] $rappayments
 */
class Rapschedules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rapschedules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rapID', 'duedate', 'expectedamount', 'comments'], 'required'],
            [['rapID'], 'integer'],
            [['duedate'], 'safe'],
            [['expectedamount'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['comments'], 'string', 'max' => 50],
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
            'rapID' => 'Remedial Action Plan',
            'name' => 'Schedule Ref',
            'duedate' => 'Due Date',
            'expectedamount' => 'Expected Amount',
            'comments' => 'Comments',
        ];
    }

    /**
     * Gets query for [[Rap]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RapQuery
     */
    public function getRap()
    {
        return $this->hasOne(Rap::class, ['id' => 'rapID']);
    }

    /**
     * Gets query for [[Rappayments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RappaymentsQuery
     */
    public function getRappayments()
    {
        return $this->hasMany(Rappayments::class, ['scheduleID' => 'id']);
    }

    public static function getSchedulesList($rap_id, $isAjax = false)
    {
        $Schedule = self::find()
            ->where(['rapID' => $rap_id]);

        if ($isAjax == true) {
            return $Schedule->select(['id', 'name'])->asArray()->all();
        } else {
            return $Schedule->select(['name'])->indexBy('id')->column();
        }
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RapschedulesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RapschedulesQuery(get_called_class());
    }
}
