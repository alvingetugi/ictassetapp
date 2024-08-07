<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "rapcommitments".
 *
 * @property int $id
 * @property int $rapID
 * @property string $name
 * @property string $duedate
 * @property float $expectedamount
 * @property string $comments
 * @property string $document
 *
 * @property Rap $rap
 * @property Rappayments[] $rappayments 
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
            [['rapID', 'duedate', 'expectedamount', 'comments', 'document'], 'required'],
            [['rapID'], 'integer'],
            [['duedate'], 'safe'],
            [['expectedamount'], 'number'],
            [['commitmentfile'], 'file', 'extensions' => 'pdf, jpg'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'duedate' => 'Due Date',
            'expectedamount' => 'Expected Amount',
            'comments' => 'Comments',
            'document' => 'Document',
            'commitmentfile' => 'Document',
        ];
    }

    /**
     * Gets query for [[Rap]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RapQuery
     */
    public function getRap()
    {
        return $this->hasOne(Rap::class, ['id' => 'rapID']);
    }

    /**
     * Gets query for [[Rappayments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RappaymentsQuery
     */
    public function getRappayments()
    {
        return $this->hasMany(Rappayments::class, ['commitmentID' => 'id']);
    }

  
    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->commitmentfile) {
            $this->document = '/uploads/' . Yii::$app->security->generateRandomString() . '/' . $this->commitmentfile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);

        if ($ok && $this->commitmentfile) {
            $fullPath = Yii::getAlias('@backend/web/storage' . $this->document);
            $dir = dirname($fullPath);
            if (!FileHelper::createDirectory($dir) | !$this->commitmentfile->saveAs($fullPath, false)) {
                $transaction->rollBack();

                return false;
            }
        }

        $transaction->commit();

        return $ok;
    }

    public function getDocumentUrl()
    {
        return self::formatDocumentUrl($this->document);
    }

    public static function formatDocumentUrl($documentPath)
    {
        if ($documentPath) {
            return Yii::$app->params['backendUrl'] . '/storage' . $documentPath;
        }

        return Yii::$app->params['backendUrl'] . '/img/no_image.svg';
    }

    public function afterDelete()
    {
        parent::afterDelete();
        if ($this->document) {
            $dir = Yii::getAlias('@backend/web/storage') . dirname($this->document);
            FileHelper::removeDirectory($dir);
        }
    }

    public static function getCommitmentsList($rap_id, $isAjax = false)
    {
        $Commitment = self::find()
            ->where(['rapID' => $rap_id]);

        if ($isAjax == true) {
            return $Commitment->select(['id', 'name'])->asArray()->all();
        } else {
            return $Commitment->select(['name'])->indexBy('id')->column();
        }
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RapcommitmentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RapcommitmentsQuery(get_called_class());
    }
}
