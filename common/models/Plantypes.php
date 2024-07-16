<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plantypes".
 *
 * @property int $id
 * @property string $ref
 * @property string $name
 */
class Plantypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plantypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref', 'name'], 'required'],
            [['ref'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
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
            'ref' => 'Plan Reference',
            'name' => 'Plan Type',
        ];
    }
}
