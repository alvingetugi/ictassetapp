<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%assetcategories}}".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 *
 * @property Assetmakes[] $assetmakes
 * @property Assetmodels[] $assetmodels
 * @property Ictassets[] $ictassets
 */
class Assetcategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%assetcategories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['name', 'description'], 'string', 'max' => 255],
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
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Assetmakes]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetmakesQuery
     */
    public function getAssetmakes()
    {
        return $this->hasMany(Assetmakes::class, ['categoryID' => 'id']);
    }

    /**
     * Gets query for [[Assetmodels]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AssetmodelsQuery
     */
    public function getAssetmodels()
    {
        return $this->hasMany(Assetmodels::class, ['categoryID' => 'id']);
    }

    /**
     * Gets query for [[Ictassets]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\IctassetsQuery
     */
    public function getIctassets()
    {
        return $this->hasMany(Ictassets::class, ['categoryID' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AssetaccessoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AssetaccessoriesQuery(get_called_class());
    }

    public static function getCategories()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }

}
