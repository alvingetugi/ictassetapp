<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%assetmakes}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property int $categoryID
 *
 * @property Assetmodels[] $assetmodels
 * @property Assetcategories $category
 * @property Ictassets[] $ictassets
 */
class Assetmakes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%assetmakes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'categoryID'], 'required'],
            [['categoryID'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name', 'description'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['categoryID'], 'exist', 'skipOnError' => true, 'targetClass' => Assetcategories::class, 'targetAttribute' => ['categoryID' => 'id']],
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
        ];
    }

    /**
     * Gets query for [[Assetmodels]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetmodelsQuery
     */
    public function getAssetmodels()
    {
        return $this->hasMany(Assetmodels::class, ['makeID' => 'id']);
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
        return $this->hasMany(Ictassets::class, ['makeID' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AssetmakesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AssetmakesQuery(get_called_class());
    }

    public static function getMakesList($cat_id, $isAjax = false)
    {
        $Make = self::find()
            ->where(['categoryID' => $cat_id]);

        if ($isAjax == true) {
            return $Make->select(['id', 'name'])->asArray()->all();
        } else {
            return $Make->select(['name'])->indexBy('id')->column();
        }
    }
}
