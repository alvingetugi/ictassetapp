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
    public $imageFile;

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
            [['imageFile'], 'image', 'extensions' => 'png, jpg, jpeg, webp, pdf', 'maxSize' => 10 * 1024 * 1024],
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
            'imageFile' => 'Document',
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

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->imageFile) {
            $this->document = '/commitmentfiles/' . Yii::$app->security->generateRandomString() . '/' . $this->imageFile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);

        if ($ok && $this->imageFile) {
            $fullPath = Yii::getAlias('@backend/web/storage' . $this->document);
            $dir = dirname($fullPath);
            if (!FileHelper::createDirectory($dir) | !$this->imageFile->saveAs($fullPath)) {
                $transaction->rollBack();

                return false;
            }
        }

        $transaction->commit();

        return $ok;
    }

    public function getImageUrl()
    {
        return self::formatImageUrl($this->document);
    }

    public static function formatImageUrl($imagePath)
    {
        if ($imagePath) {
            return Yii::$app->params['backendUrl'] . '/storage' . $imagePath;
        }

        return Yii::$app->params['backendUrl'] . '/img/no_image.svg';
    }

    public function afterDelete()
    {
        parent::afterDelete();
        if ($this->document) {
            $dir = Yii::getAlias('@backend/web/storage'). dirname($this->document);
            FileHelper::removeDirectory($dir);
        }
    }
}
