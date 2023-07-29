<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property Equipmentmodel[] $equipmentmodels
 * @property Equipment[] $equipments
 * @property Make[] $makes
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
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

    /**
     * Gets query for [[Equipmentmodels]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EquipmentmodelQuery
     */
    public function getEquipmentmodels()
    {
        return $this->hasMany(Equipmentmodel::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Equipments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EquipmentQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Makes]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MakeQuery
     */
    public function getMakes()
    {
        return $this->hasMany(Make::class, ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CategoryQuery(get_called_class());
    }

    //Gets all categories from category model
    public static function getCategories()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}