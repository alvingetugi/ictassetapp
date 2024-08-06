<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "schemes".
 *
 * @property int $id
 * @property string $ref
 * @property string $type
 * @property string $name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Rap[] $raps
 */
class Schemes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schemes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref', 'type', 'name'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['ref'], 'string', 'max' => 50],
            [['type', 'name'], 'string', 'max' => 255],
            [['ref'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'Ref',
            'type' => 'Type',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Raps]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RapQuery
     */
    public function getRaps()
    {
        return $this->hasMany(Rap::class, ['schemeID' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SchemesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SchemesQuery(get_called_class());
    }
}
