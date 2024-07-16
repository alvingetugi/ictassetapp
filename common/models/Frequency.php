<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "frequency".
 *
 * @property int $id
 * @property string $ref
 * @property string $frequency
 */
class Frequency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frequency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref', 'frequency'], 'required'],
            [['ref', 'frequency'], 'string', 'max' => 50],
            [['frequency'], 'unique'],
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
            'frequency' => 'Frequency',
        ];
    }
}
