<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "issuances".
 *
 * @property int $id
 * @property string $code
 * @property string $issuancedate
 * @property int $assetID
 * @property int $categoryID
 * @property int $modelID
 * @property int $serialnumber
 * @property string|null $accessorylistID 
 * @property int $userID
 * @property string $comments
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Issuances extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'issuances';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['issuancedate','categoryID', 'modelID', 'serialnumber', 'userID', 'comments'], 'required'],
            [['issuancedate', 'accessorylistID'], 'safe'],
            [['categoryID', 'modelID', 'serialnumber', 'userID', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['comments'], 'string', 'max' => 255],
            // [['accessorylistID'], 'string', 'max' => 300],
            [['code'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
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
            'issuancedate' => 'Issuance date',
            'categoryID' => 'Category',
            'modelID' => 'Model',
            'serialnumber' => 'Serial Number',
            'accessorylistID' => 'Accessories',
            'userID' => 'Staff',
            'comments' => 'Comments',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Surrenders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSurrenders()
    {
        return $this->hasMany(Surrenders::class, ['issuanceID' => 'id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getModel()
    {
        return $this->hasOne(Assetmodels::class, ['id' => 'modelID']);
    }

    public function getSerials()
    {
        return $this->hasOne(Ictassets::class, ['id' => 'serialnumber']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userID']);
    }
}
