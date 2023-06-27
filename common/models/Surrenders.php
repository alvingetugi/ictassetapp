<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%surrenders}}".
 *
 * @property int $id
 * @property int $issuance_id
 * @property string $firstname
 * @property string $lastname
 * @property string $department
 * @property string $model
 * @property string $serial_number
 * @property string $tag_number
 * @property string $ram
 * @property string $storage
 * @property string $accessories
 * @property string $condition
 * @property int|null $created_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 * @property Issuances $issuance
 */
class Surrenders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%surrenders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['issuance_id', 'firstname', 'lastname', 'department', 'model', 'serial_number', 'tag_number', 'ram', 'storage', 'accessories', 'condition'], 'required'],
            [['issuance_id', 'created_at', 'created_by'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 45],
            [['department', 'model', 'serial_number', 'tag_number', 'ram', 'storage', 'accessories', 'condition'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['issuance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Issuances::class, 'targetAttribute' => ['issuance_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'issuance_id' => Yii::t('app', 'Issuance ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'department' => Yii::t('app', 'Department'),
            'model' => Yii::t('app', 'Model'),
            'serial_number' => Yii::t('app', 'Serial Number'),
            'tag_number' => Yii::t('app', 'Tag Number'),
            'ram' => Yii::t('app', 'Ram'),
            'storage' => Yii::t('app', 'Storage'),
            'accessories' => Yii::t('app', 'Accessories'),
            'condition' => Yii::t('app', 'Condition'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
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
     * Gets query for [[Issuance]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\IssuancesQuery
     */
    public function getIssuance()
    {
        return $this->hasOne(Issuances::class, ['id' => 'issuance_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SurrendersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SurrendersQuery(get_called_class());
    }
}
