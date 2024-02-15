<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%assetmodels}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property int $categoryID
 * @property int $makeID
 *
 * @property Assetcategories $category
 * @property Ictassets[] $ictassets
 * @property Assetmakes $make
 */
class Assetmodels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%assetmodels}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'categoryID', 'makeID'], 'required'],
            [['categoryID', 'makeID'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name', 'description'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['categoryID'], 'exist', 'skipOnError' => true, 'targetClass' => Assetcategories::class, 'targetAttribute' => ['categoryID' => 'id']],
            [['makeID'], 'exist', 'skipOnError' => true, 'targetClass' => Assetmakes::class, 'targetAttribute' => ['makeID' => 'id']],
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
            'categoryID' => 'Category',
            'makeID' => 'Make',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetcategoriesQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Assetcategories::class, ['id' => 'categoryID']);
    }

    /**
     * Gets query for [[Ictassets]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\IctassetsQuery
     */
    public function getIctassets()
    {
        return $this->hasMany(Ictassets::class, ['modelID' => 'id']);
    }

    /**
     * Gets query for [[Make]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetmakesQuery
     */
    public function getMake()
    {
        return $this->hasOne(Assetmakes::class, ['id' => 'makeID']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AssetmodelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AssetmodelsQuery(get_called_class());
    }

    public static function getModelsList($cat_id, $make_id, $isAjax = false)
    {
        $model = self::find()
            ->where(['categoryID' => $cat_id])
            ->andWhere(['makeID' => $make_id]);

        if ($isAjax) {
            return $model->select(['id', 'name'])->asArray()->all();
        } else {
            return $model->select(['name'])->indexBy('id')->column();
        }
    }

    public static function getModelListissuance($cat_id, $isAjax = false)
    {
        $Modelissuance = self::find()
            ->where(['categoryID' => $cat_id]);

        if ($isAjax == true) {
            return $Modelissuance->select(['id', 'name'])->asArray()->all();
        } else {
            return $Modelissuance->select(['name'])->indexBy('id')->column();
        }
    }
}
