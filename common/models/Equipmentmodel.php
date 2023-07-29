<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%equipmentmodel}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $category_id
 * @property int $make_id
 *
 * @property Category $category
 * @property Equipment[] $equipments
 * @property Make $make
 */
class Equipmentmodel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%equipmentmodel}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'category_id', 'make_id'], 'required'],
            [['category_id', 'make_id'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['make_id'], 'exist', 'skipOnError' => true, 'targetClass' => Make::class, 'targetAttribute' => ['make_id' => 'id']],
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
            'make_id' => 'Make ID',
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
     * Gets query for [[Equipments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EquipmentQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::class, ['equipmodel_id' => 'id']);
    }

    /**
     * Gets query for [[Make]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MakeQuery
     */
    public function getMake()
    {
        return $this->hasOne(Make::class, ['id' => 'make_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\EquipmentmodelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\EquipmentmodelQuery(get_called_class());
    }

    public static function getModelsList($cat_id, $make_id, $isAjax = false)
    {
        $model = self::find()
            ->where(['category_id' => $cat_id])
            ->andWhere(['make_id' => $make_id]);

        if ($isAjax) {
            return $model->select(['id', 'name'])->asArray()->all();
        } else {
            return $model->select(['name'])->indexBy('id')->column();
        }
    }
}