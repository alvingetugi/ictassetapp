<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "rappayments".
 *
 * @property int $id
 * @property int $rapID
 * @property string $date
 * @property float $amount
 * @property string $comments
 * @property string $proof
 *
 * @property Rap $rap
 */
class Rappayments extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $paymentfile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rappayments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rapID', 'date', 'amount', 'comments', 'proof'], 'required'],
            [['rapID'], 'integer'],
            [['date'], 'safe'],
            [['amount'], 'number'],
            [['paymentfile'], 'file', 'extensions' => 'pdf, jpg'],
            [['comments'], 'string', 'max' => 50],
            [['proof'], 'string', 'max' => 2000],
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
            'date' => 'Date',
            'amount' => 'Amount',
            'comments' => 'Comments',
            'proof' => 'Proof',
            'paymentfile' => 'Proof',
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
        if ($this->paymentfile) {
            $this->proof = '/uploads/' . Yii::$app->security->generateRandomString() . '/' . $this->paymentfile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);

        if ($ok && $this->paymentfile) {
            $fullPath = Yii::getAlias('@backend/web/storage' . $this->proof);
            $dir = dirname($fullPath);
            if (!FileHelper::createDirectory($dir) | !$this->paymentfile->saveAs($fullPath)) {
                $transaction->rollBack();

                return false;
            }
        }

        $transaction->commit();

        return $ok;
    }

    public function getProofUrl()
    {
        return self::formatProofUrl($this->proof);
    }

    public static function formatProofUrl($proofPath)
    {
        if ($proofPath) {
            return Yii::$app->params['backendUrl'] . '/storage' . $proofPath;
        }

        return Yii::$app->params['backendUrl'] . '/img/no_image.svg';
    }

    public function afterDelete()
    {
        parent::afterDelete();
        if ($this->proof) {
            $dir = Yii::getAlias('@backend/web/storage'). dirname($this->proof);
            FileHelper::removeDirectory($dir);
        }
    }
}
