<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string $name
 * @property string $responsible
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'responsible'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['responsible'], 'string', 'max' => 255],
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
            'responsible' => 'Responsible',
        ];
    }
}
