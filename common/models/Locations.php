<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%locations}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 *
 * @property Ictassets[] $ictassets
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%locations}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['name', 'description'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Ictassets]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\IctassetsQuery
     */
    public function getIctassets()
    {
        return $this->hasMany(Ictassets::class, ['locationID' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\LocationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LocationsQuery(get_called_class());
    }
}
