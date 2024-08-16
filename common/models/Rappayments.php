<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "rappayments".
 *
 * @property int $id
 * @property int $rapID
 * @property int $scheduleID
 * @property string $name
 * @property string $paymentdate
 * @property float $amount
 * @property string $comments
 * @property string $proof
 *
 * @property Rapschedules $schedule 
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
            [['rapID', 'scheduleID', 'paymentdate', 'amount', 'comments', 'proof'], 'required'],
            [['rapID', 'scheduleID'], 'integer'],
            [['paymentdate'], 'safe'],
            [['amount'], 'number'],
            [['paymentfile'], 'file', 'extensions' => 'pdf, jpg'],
            [['name'], 'string', 'max' => 255],
            [['comments'], 'string', 'max' => 50],
            [['proof'], 'string', 'max' => 2000],
            [['rapID'], 'exist', 'skipOnError' => true, 'targetClass' => Rap::class, 'targetAttribute' => ['rapID' => 'id']],
            [['scheduleID'], 'exist', 'skipOnError' => true, 'targetClass' => Rapschedules::class, 'targetAttribute' => ['scheduleID' => 'id']],
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
            'scheduleID' => 'Schedule',
            'name' => 'Name',
            'paymentdate' => 'Payment Date',
            'amount' => 'Amount',
            'comments' => 'Comments',
            'proof' => 'Proof',
            'paymentfile' => 'Proof',
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
    * Gets query for [[Schedule]].
    *
    * @return \yii\db\ActiveQuery|\common\models\query\RapschedulesQuery
    */
    public function getSchedule()
    {
        return $this->hasOne(Rapschedules::class, ['id' => 'scheduleID']);
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
            if (!FileHelper::createDirectory($dir) | !$this->paymentfile->saveAs($fullPath, false)) {
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
            $dir = Yii::getAlias('@backend/web/storage') . dirname($this->proof);
            FileHelper::removeDirectory($dir);
        }
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RappaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RappaymentsQuery(get_called_class());
    }
}
