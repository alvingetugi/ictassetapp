<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "maintenancein".
 *
 * @property int $id
 * @property string $code
 * @property string $inwarddate
 * @property int $categoryID
 * @property int $modelID
 * @property int $serialnumber
 * @property int|null $accessorylistID
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
class Maintenancein extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maintenancein';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'inwarddate', 'categoryID', 'modelID', 'serialnumber', 'userID', 'comments'], 'required'],
            [['inwarddate'], 'safe'],
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
            'inwarddate' => 'Inwarddate',
            'categoryID' => 'Category ID',
            'modelID' => 'Model ID',
            'serialnumber' => 'Serialnumber',
            'accessorylistID' => 'Accessorylist ID',
            'userID' => 'User ID',
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
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MaintenanceinQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MaintenanceinQuery(get_called_class());
    }
}
