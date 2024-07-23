<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "rapcommitments".
 *
 * @property int $id
 * @property int $rapID
 * @property string $date
 * @property float $expectedamount
 * @property string $comments
 * @property string $document
 *
 * @property Rap $rap
 */
class Rapcommitments extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $commitmentfile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rapcommitments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rapID', 'date', 'expectedamount', 'comments', 'document'], 'required'],
            [['rapID'], 'integer'],
            [['date'], 'safe'],
            [['expectedamount'], 'number'],
            [['commitmentfile'], 'file', 'extensions' => 'pdf'],
            [['comments'], 'string', 'max' => 50],
            [['document'], 'string', 'max' => 2000],
            [['rapID'], 'exist', 'skipOnError' => true, 'targetClass' => Rap::class, 'targetAttribute' => ['rapID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rapID' => 'Remedial Action Plan',
            'date' => 'Due Date',
            'expectedamount' => 'Expected Amount',
            'comments' => 'Comments',
            'document' => 'Document',
            'commitmentfile' => 'Document',
        ];
    }

    /**
     * Gets query for [[Rap]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRap()
    {
        return $this->hasOne(Rap::class, ['id' => 'rapID']);
    }

    // public function upload()
    // {
    //     if ($this->validate()) {
    //         $this->commitmentfile->saveAs('uploads/' . $this->commitmentfile->baseName . '.' . $this->commitmentfile->extension);
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

}
