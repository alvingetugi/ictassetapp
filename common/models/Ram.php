<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ram".
 *
 * @property int $id
 * @property string $name
 *
 * @property Ictassets[] $ictassets
 */
class Ram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ram';
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
        return $this->hasMany(Ictassets::class, ['ramID' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RamQuery(get_called_class());
    }
}
