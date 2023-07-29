<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%make}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $category_id
 *
 * @property Category $category
 * @property Equipmentmodel[] $equipmentmodels
 * @property Equipment[] $equipments
 */
class Make extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%make}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Equipmentmodels]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EquipmentmodelQuery
     */
    public function getEquipmentmodels()
    {
        return $this->hasMany(Equipmentmodel::class, ['make_id' => 'id']);
    }

    /**
     * Gets query for [[Equipments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EquipmentQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::class, ['make_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MakeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MakeQuery(get_called_class());
    }

    public static function getMakesList($cat_id, $isAjax = false)
    {
        $Make = self::find()
            ->where(['category_id' => $cat_id]);

        if ($isAjax == true) {
            return $Make->select(['id', 'name'])->asArray()->all();
        } else {
            return $Make->select(['name'])->indexBy('id')->column();
        }
    }
}
