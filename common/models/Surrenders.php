<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "surrenders".
 *
 * @property int $id
 * @property string $code
 * @property string $surrenderdate
 * @property int $categoryID
 * @property int $modelID
 * @property int $serialnumber
 *  @property int|null $accessorylistID 
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
class Surrenders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'surrenders';
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
            [['surrenderdate', 'categoryID', 'modelID', 'serialnumber', 'userID', 'comments'], 'required'],
            [['surrenderdate'], 'safe'],
            [['categoryID', 'modelID', 'serialnumber', 'accessorylistID', 'userID', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['comments'], 'string', 'max' => 255],
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
            'surrenderdate' => 'Surrenderdate',
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
