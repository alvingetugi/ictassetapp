<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "operatingsystem".
 *
 * @property int $id
 * @property string $name
 *
 * @property Ictassets[] $ictassets
 */
class Operatingsystem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operatingsystem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
     * Gets query for [[Ictassets]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\IctassetsQuery
     */
    public function getIctassets()
    {
        return $this->hasMany(Ictassets::class, ['osID' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OperatingsystemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OperatingsystemQuery(get_called_class());
    }
}
