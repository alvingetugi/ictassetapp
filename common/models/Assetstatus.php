<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assetstatus".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 */
class Assetstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assetstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 50],
            [['name'], 'unique'],
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
        ];
    }
}
