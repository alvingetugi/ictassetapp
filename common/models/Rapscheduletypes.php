<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rapscheduletypes".
 *
 * @property int $id
 * @property string $name
 *
 * @property Rapschedules[] $rapschedules
 */
class Rapscheduletypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rapscheduletypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Rapschedules]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RapschedulesQuery
     */
    public function getRapschedules()
    {
        return $this->hasMany(Rapschedules::class, ['rapscheduletypeID' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RapscheduletypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RapscheduletypesQuery(get_called_class());
    }

    public static function getSchedules()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
