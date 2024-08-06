<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "rap".
 *
 * @property int $id
 * @property int $typeID
 * @property int $schemeID
 * @property string $name
 * @property int $status
 * @property float $amount
 * @property string $startdate
 * @property string $enddate
 * @property string $comments
 * @property string $rapdocument
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Rapcommitments[] $rapcommitments
 * @property Rappayments[] $rappayments
 * @property Schemes $scheme
 * @property Raptypes $type
 * @property User $updatedBy
 */
class Rap extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $rapfile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['typeID', 'schemeID', 'status', 'amount', 'startdate', 'enddate', 'comments', 'rapdocument'], 'required'],
            [['typeID', 'schemeID', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['amount'], 'number'],
            [['startdate', 'enddate'], 'safe'],
            [['name', 'comments'], 'string', 'max' => 255],
            [['rapdocument'], 'string', 'max' => 2000],
            [['rapfile'], 'file', 'extensions' => 'pdf, jpg'],
            [['typeID'], 'exist', 'skipOnError' => true, 'targetClass' => Raptypes::class, 'targetAttribute' => ['typeID' => 'id']],
            [['schemeID'], 'exist', 'skipOnError' => true, 'targetClass' => Schemes::class, 'targetAttribute' => ['schemeID' => 'id']],
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
            'typeID' => 'Type',
            'schemeID' => 'Scheme',
            'name' => 'Name',
            'status' => 'Status',
            'amount' => 'Amount',
            'startdate' => 'Start Date',
            'enddate' => 'End Date',
            'comments' => 'Comments',
            'rapdocument' => 'Documentation',
            'rapfile' => 'Documentation',
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
     * Gets query for [[Rapcommitments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RapcommitmentsQuery
     */
    public function getRapcommitments()
    {
        return $this->hasMany(Rapcommitments::class, ['rapID' => 'id']);
    }

    /**
     * Gets query for [[Rappayments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RappaymentsQuery
     */
    public function getRappayments()
    {
        return $this->hasMany(Rappayments::class, ['rapID' => 'id']);
    }

    /**
     * Gets query for [[Scheme]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SchemesQuery
     */
    public function getScheme()
    {
        return $this->hasOne(Schemes::class, ['id' => 'schemeID']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RaptypesQuery
     */
    public function getType()
    {
        return $this->hasOne(Raptypes::class, ['id' => 'typeID']);
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

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->rapfile) {
            $this->rapdocument = '/uploads/' . Yii::$app->security->generateRandomString() . '/' . $this->rapfile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);

        if ($ok && $this->rapfile) {
            $fullPath = Yii::getAlias('@backend/web/storage' . $this->rapdocument);
            $dir = dirname($fullPath);
            if (!FileHelper::createDirectory($dir) | !$this->rapfile->saveAs($fullPath, false)) {
                $transaction->rollBack();

                return false;
            }
        }

        $transaction->commit();

        return $ok;
    }

    public function getDocumentUrl()
    {
        return self::formatDocumentUrl($this->rapdocument);
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
        if ($this->rapdocument) {
            $dir = Yii::getAlias('@backend/web/storage'). dirname($this->rapdocument);
            FileHelper::removeDirectory($dir);
        }
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RapQuery(get_called_class());
    }

    public static function getRaps()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
